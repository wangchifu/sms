<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchStus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_stus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('semester'); //學期
            $table->unsignedInteger('no'); //學號
            $table->unsignedInteger('class_num'); //班級
            $table->string('name');
            $table->unsignedInteger('sex'); //性別
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_stus');
    }
}
