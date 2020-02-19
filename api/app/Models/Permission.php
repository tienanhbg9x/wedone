<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 14:31
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    public $table = "permissions";

    static $columns_alias = [
        'id', 'title'
    ];


    static function alias($fields = null)
    {
        $newFields = [];
        if ($fields == "*" || empty($fields)) {
            foreach (self::$columns_alias as $alias) {
                if(in_array($alias,self::$columns_alias)){
                    $newFields[] = $alias;
                }
            }
        }else{
            $fields = explode(",", $fields);
            foreach ($fields as $alias) {
                $field = in_array($alias,self::$columns_alias);
                if ($field) $newFields[] = $alias;
            }
        }
        return $newFields;
    }
}
