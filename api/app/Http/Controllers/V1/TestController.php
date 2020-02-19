<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 14:22
 */

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;

class TestController extends  Controller
{
    function index(Request $request){
        return $request->all();
    }

}