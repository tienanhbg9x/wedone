<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 14:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = "roles";

    static $columns_alias = [
        'id', 'title'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    static function alias($fields = null)
    {
        $newFields = [];
        if ($fields == "*" || empty($fields)) {
            foreach (self::$columns_alias as $alias) {
                if (in_array($alias, self::$columns_alias)) {
                    $newFields[] = $alias;
                }
            }
        } else {
            $fields = explode(",", $fields);
            foreach ($fields as $alias) {
                $field = in_array($alias, self::$columns_alias);
                if ($field) $newFields[] = $alias;
            }
        }
        return $newFields;
    }

}