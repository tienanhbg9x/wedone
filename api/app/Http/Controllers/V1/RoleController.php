<?php


namespace App\Http\Controllers\V1;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::select(Role::alias($this->fields));
        if (!empty($this->where)) $roles = whereQueryBuilder($this->where, $roles, 'mysql', 'roles');
        if (!empty($this->where_in)) $roles = whereInQueryBuilder($this->where, $roles, 'mysql', 'roles');
        $roles = $roles->orderBy('id', 'asc')->offset($this->offset)->limit($this->limit)->get();
        return $this->createResponse([
            'current_page' => $this->page,
            'per_page' => $this->limit,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'id' => 'integer',
                'title' => 'string|min:3|max:255',
            ],
            [
                'title.string' => 'Kiểu dữ liệu sai',
                'title.min' => 'Tên quyền quá ngắn',
                'title.max' => 'Tên quyền quá dài',
                'id.integer' => 'Kiểu dữ liệu không đúng',
                'title.unique' => 'Tên quyền đã tồn tại'
            ]);
        if ($validator->fails()) {
            return $this->createResponse(collect($validator->messages())->collapse(), HTTP_CODE_NOT_VALID);
        }
        $role = new Role();
        $role->id = $request->input('id');
        $role->title = $request->input('title');
        $role->save();
        return $this->createResponse(['message' => 'Thêm thành công'], HTTP_CODE_SUCCESS);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'title' => 'string|min:3|max:255',
        ], [
            'title.string' => 'Kiểu dữ liệu sai',
            'title.min' => 'Tên quyền quá ngắn',
            'title.max' => 'Tiêu quyền quá dài',
            'id.integer' => 'Kiểu dữ liệu không đúng',
        ]);
        if ($validator->fails()) {
            return $this->createResponse(collect($validator->messages())->collapse(), HTTP_CODE_NOT_VALID);
        }
        $role = Role::find($id);
        if (empty($role)) return $this->createResponse(['message' => 'Không tìm thấy id user'], HTTP_CODE_NOT_FOUND);
        $role->title = $request->input('title');
        $role->save();
        return $this->createResponse(['message' => 'Sửa thành công'], HTTP_CODE_SUCCESS);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) return $this->createResponse(['message' => 'Không tìm thấy bản ghi'], HTTP_CODE_NOT_FOUND);
        $role->delete();
        return $this->createResponse(['message' => 'xóa thành công'], HTTP_CODE_SUCCESS);
    }
}
