<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubBlacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_blacks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('semester');
            $table->unsignedInteger('student_id');       
            $table->tinyInteger('class_id');     
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
        Schema::dropIfExists('club_blacks');
    }
}
