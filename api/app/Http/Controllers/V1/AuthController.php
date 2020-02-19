<?php
namespace App\Http\Controllers\V1;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        if ($validator->fails()) return $this->createResponse($validator->errors(), 403);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if ($user->active == 0) {
                    return $this->createResponse(['message' => 'Tài khoản đang bị khóa!'], 500);
                }
                return $this->createResponse(['access_token' => createJwt(['id' => $user->id], $user->password, 365 * 24 * 3600), 'user_id' => $user->id],HTTP_CODE_SUCCESS);
            } else {
                return $this->createResponse(['message' => 'Mật khẩu không đúng'], HTTP_CODE_PERMISSION);
            }
        }
        return $this->createResponse(['Tài khoản không tồn tại!'], HTTP_CODE_NOT_FOUND);
    }

    public function register(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|string|min:6|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
//                 'password_confirmation' => 'required|same:password|min:6'
            ]);
        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 12]);
            $user->save();

            $token = createJwtAction([
                'id' => $user->id,
                'email' => $user->email
            ], 'verify_user', $user->password,8600);
            $user = $user->toArray();
            unset($user['password']);
            dispatch(new SendEmailJob($token,$user));

            return $this->createResponse(['user' => $user]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Đăng ký thất bại','error'=>$e->getMessage()], 409);
        }
    }

    public function verifyEmail(Request $request){
        $this->validate($request,
            [
                'token'=>'required|string',
            ]);
        $info_token = decodeJwt($request->token);
        $token = $request->token;
        $user_id = $info_token['data']['id'];
        $user = User::where('id',$user_id)->first();
        if($user){
            if($user->active==0){
                try{
                    $token = JWT::decode($token,$user->password,['HS256']);
                    $user->active = 1;
                    if($user->save()){
                        return redirect(env('URL_VUE').'/verify');
                    }
                }catch (\Exception $error){
                    dd($error->getMessage());
                }
            }else{
                redirect(env('URL_VUE').'/login');
            }
        }
        else {
            redirect(env('URL_VUE').'/login');
        }
    }
}
