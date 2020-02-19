<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'active', 'id', 'created_at'
    ];

    static $columns_alias = [
        'name', 'email', 'active', 'id', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
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
