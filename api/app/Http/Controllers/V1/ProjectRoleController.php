<?php


namespace App\Http\Controllers\V1;


use App\Models\ProjectRole;

class ProjectRoleController extends Controller
{
    function index(){
        $project_role = ProjectRole::select(ProjectRole::alias($this->fields));
        if(!empty($this->where)) $project_role =  whereQueryBuilder($this->where,$project_role,'mysql','project_role');
        if(!empty($this->where_in)) $project_role = whereInQueryBuilder($this->where,$project_role,'mysql','project_role');
        $project_role = $project_role->orderBy('ppr_id','desc')->offset($this->offset)->limit($this->limit)->get();
        return $this->createResponse([
            'current_page'=>$this->page,
            'per_page'=>$this->limit,
            'project_role'=>$project_role
        ]);

    }

}