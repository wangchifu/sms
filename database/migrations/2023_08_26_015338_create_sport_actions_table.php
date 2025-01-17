<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semester');            
            $table->string('name');//
            $table->unsignedInteger('track');//每人可報徑賽有幾項
            $table->unsignedInteger('field');//每人可報田賽有幾項
            $table->unsignedInteger('frequency');//每人可報合計有幾項
            $table->unsignedInteger('numbers');//號碼布數字幾位數
            $table->tinyInteger('disable')->nullable();//停用            
            $table->string('started_at')->nullable();//
            $table->string('stopped_at')->nullable();//
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
        Schema::dropIfExists('sport_actions');
    }
}
