<?php


namespace App\Http\Controllers\V1;


use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::select(Permission::alias($this->fields));
        if (!empty($this->where)) $permissions = whereQueryBuilder($this->where, $permissions, 'mysql', 'permissions');
        if (!empty($this->where_in)) $permissions = whereInQueryBuilder($this->where, $permissions, 'mysql', 'permissions');
        $permissions = $permissions->orderBy('id', 'asc')->offset($this->offset)->limit($this->limit)->get();
        return $this->createResponse([
            'current_page' => $this->page,
            'per_page' => $this->limit,
            'permissions' => $permissions
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
        $permission = new Permission();
        $permission->id = $request->input('id');
        $permission->title = $request->input('title');
        $permission->save();
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
        $permission = Permission::find($id);
        if (empty($permission)) return $this->createResponse(['message' => 'Không tìm thấy bản ghi'], HTTP_CODE_NOT_FOUND);
        $permission->title = $request->input('title');
        $permission->save();
        return $this->createResponse(['message' => 'Sửa thành công'], HTTP_CODE_SUCCESS);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (!$permission) return $this->createResponse("Không tìm thấy bản ghi", HTTP_CODE_NOT_FOUND);
        $permission->delete();
        return $this->createResponse(['message' => 'xóa thành công'], HTTP_CODE_SUCCESS);
    }
}
