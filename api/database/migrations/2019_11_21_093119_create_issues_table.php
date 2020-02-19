<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('iss_id');
            $table->string('iss_name')->nullable();
            $table->text('iss_description')->nullable();
            $table->integer('iss_user_id')->default(0);
            $table->integer('iss_pro_id')->default(0);
            $table->integer('iss_com_id')->default(0);
            $table->tinyInteger('iss_label')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
