<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    public $table = 'project_role';
    protected $primaryKey = 'ppr_id';
    public $timestamps = false;

    static $columns_alias = [
        'ppr_id'=>'id',
        'ppr_title' =>'title'
    ];

    static function alias($fields = null)
    {
        $newFields = [];
        if ($fields == "*" || empty($fields)) {
            foreach (self::$columns_alias as $key=>$alias) {
                if(array_search($alias,self::$columns_alias)){
                    $newFields[] = $key." AS ".$alias;
                }
            }
        }else{
            $fields = explode(",", $fields);
            foreach ($fields as $alias) {
                $field = array_search($alias,self::$columns_alias);
                if ($field) $newFields[] = $field . " AS " . $alias;
            }
        }
        return $newFields;
    }
}