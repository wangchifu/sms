<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('semester'); //學期
            $table->unsignedInteger('class_id'); //班級
            $table->string('class_name'); //班級
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
        Schema::dropIfExists('lunch_classes');
    }
}
