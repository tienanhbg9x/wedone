<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 22/10/2019
 * Time: 09:56
 */

define("APP_URL", env('APP_URL','http://localhost:8080'));
define("HTTP_CODE_SUCCESS",200);
define("HTTP_CODE_CREATED",201);
define("HTTP_CODE_REMOVED",204);
define("HTTP_CODE_NOT_VALID",400);
define("HTTP_CODE_NOT_FOUND",404);
define("HTTP_CODE_CONFLICT",409);
define("HTTP_CODE_PERMISSION",401);