<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
                    $table->unsignedInteger('role_id')->default(0);
                    $table->unsignedInteger('permission_id')->default(0);
                });

    }
}
