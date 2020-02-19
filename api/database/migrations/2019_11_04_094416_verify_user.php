<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VerifyUser extends Migration
{

    public function up()
    {
        Schema::create('verify_users',function (Blueprint $table) {

            $table->integer('user_id');

            $table->string('access_token');

            $table->timestamps();
        });
    }

    public function down()
    {
        //
    }
}