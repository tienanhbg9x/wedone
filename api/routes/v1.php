<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 14:19
 */

$router->get('/', function () {
    return ['version' => 'api v1'];
});

//login
$router->get('test', 'TestController@index');

$router->post('login', 'AuthController@login');

$router->post('register', 'AuthController@register');

//users
$router->get('user/verify', 'AuthController@verifyEmail');

$router->get('users', 'UserController@index');

$router->get('user/{user_id}','UserController@show');

$router->post('users', 'UserController@store');

$router->get('permissions', 'UserController@permissions');

$router->delete('user-delete/{id}','UserController@destroy');

//role
$router->get('roles', 'RoleController@index');

$router->post('role-create', 'RoleController@store');

$router->put('role-edit/{id}', 'RoleController@update');

$router->delete('role-delete/{id}', 'RoleController@destroy');

//permission
$router->get('permissions', 'PermissionController@index');

$router->post('permission-create', 'PermissionController@store');

$router->put('permission-edit/{id}', 'PermissionController@update');

$router->delete('permission-delete/{id}', 'PermissionController@destroy');

//permission role


//projects_role
$router->get('project-role', 'ProjectRoleController@index');
