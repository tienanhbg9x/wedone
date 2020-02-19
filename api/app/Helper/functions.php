<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 16:50
 */

function createPassword($password){
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function createJwt($data,$key,$exp=3600){
    $time_now = time();
    $exp = $time_now + $exp;
    $data = [
        "data" => $data,
        "iat" => $time_now,
        "exp" => $exp
    ];
    $token = Firebase\JWT\JWT::encode($data, env('JWT_SECRET').$key);
    return $token;
}

function createJwtAction($data,$action,$key,$exp=3600){
    $time_now = time();
    $exp = $time_now + $exp;
    $data['action'] = $action;
    $data = [
        "data" => $data,
        "iat" => $time_now,
        "exp" => $exp
    ];
    $token = Firebase\JWT\JWT::encode($data, env('JWT_SECRET').$key);
    return $token;
}

function decodeJwt($token){
    if(preg_match("/(.*)\.(.*)\.(.*)/",$token,$match)){
//dd($match);
        return json_decode(base64_decode($match[2]),true);
    }
}


function whereQueryBuilder($where, $model, $connection, $table)
{
    $databases_config = config('alias_database');
    if (isset($databases_config[$connection][$table])) {
        $databases_config = $databases_config[$connection][$table];
        $options = explode(',', $where);
        foreach ($options as $value) {
            $value = explode(" ", $value);
            if (isset($value[1]) && key_exists($value[0], $databases_config)) {
                $data_column = $databases_config[$value[0]];
                $type = $data_column['type'];
                switch ($type) {
                    case 'int':
                        $value[1] = (int)$value[1];
                        $model = $model->where($data_column['column'], $value[1]);
                        break;
                    case 'string':
                        $value[1] = trim($value[1]);
                        if (in_array($value[1], $data_column['values'])) {
                            $model = $model->where($data_column['column'], $value[1]);
                        }
                        break;
                }
            }

        }
    }
    return $model;
}

function whereInQueryBuilder($where,$model,$collection,$table){
    $where = explode(' ',$where);
    $field = current($where);
    $values = explode(',',end($where));
    $config_field = config("alias_database.$collection.$table.$field");
    if(!empty($config_field)){
        $field = $config_field['column'];
        $value_return = [];
        switch ($config_field['type']){
            case 'int':
                foreach ($values as $value){
                    $value_return[] = (int)$value;
                }
                break;
            case 'double':
                foreach ($values as $value){
                    $value_return[] = (double)$value;
                }
                break;
            case 'string':
                $value_check = $config_field['values'];
                foreach ($values as $value){
                    if(array_search($value,$value_check)) $value_return[] = $value;
                }
                break;
        }
        if(empty($value_return)) return $model;
        return $model->whereIn($field,$value_return);
    }else{
        return $model;
    }
}