<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchClassDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_class_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_class_id');
            $table->string('order_date');
            $table->unsignedInteger('semester');
            $table->unsignedInteger('lunch_order_id');
            $table->string('lunch_factory_id');
            $table->unsignedInteger('eat_style1')->nullable();
            $table->unsignedInteger('eat_style2')->nullable();
            $table->unsignedInteger('eat_style3')->nullable();
            $table->unsignedInteger('eat_style4')->nullable();
            $table->unsignedInteger('eat_style4_egg')->nullable();
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
        Schema::dropIfExists('lunch_class_dates');
    }
}
