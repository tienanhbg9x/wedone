<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 16:24
 */

namespace App\Http\Controllers\V1;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class UserController extends Controller
{
//    public function toArray(Request $request) {
//        $defaultData = parent::toArray($request);
//
//        $additionalData = [
//          'role' => $this->roles->first();
//        ];
//    }
    /**
     * @OA\Post(
     *     path="/api/v1/users",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */

    function index(){
        $users = User::select(User::alias($this->fields));
        if(!empty($this->where)) $users =  whereQueryBuilder($this->where,$users,'mysql','users');
        if(!empty($this->where_in)) $users = whereInQueryBuilder($this->where,$users,'mysql','users');
        $users = $users->orderBy('id','asc')->offset($this->offset)->limit($this->limit)->get();
        return $this->createResponse([
            'current_page'=>$this->page,
            'per_page'=>$this->limit,
            'users'=>$users
        ]);
    }

    function store(Request $request){
        $user_check = User::where('email',$request->email)->first();
        if(empty($user_check)){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT, ['cost' => 12]);
            if($user->save()){
                return $this->createResponse('create');
            }
            return $this->createResponse('save user error',500);

        }
        return $this->createResponse('User đã tồn tại',500);
    }

    function update(Request $request,$id){

    }

    public function show(Request $request,$id){
        $user = new User();
        $user = User::select($user->alias($this->fields))->where('id',$id)->first();
        if(!$user) return $this->createResponse(['message'=>'Không tìm thấy user'.$id],HTTP_CODE_NOT_FOUND);
        return $this->createResponse($user,HTTP_CODE_SUCCESS);
    }

    public function destroy(Request $request,$id){
        $user = User::find($id);
        if(!$user) return $this->createResponse(['message'=>'Không tìm thấy bản ghi'],HTTP_CODE_NOT_FOUND);
        $user->delete();
        return $this->createResponse(['message'=>'Xóa thành công'],HTTP_CODE_SUCCESS);
    }

}
