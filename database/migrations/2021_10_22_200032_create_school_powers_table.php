<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolPowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_powers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school_code'); //學校代碼
            $table->string('user_id');
            $table->string('module'); //模組名稱
            $table->tinyInteger('power_type')->nullable(); //權限 1最高管理者
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
        Schema::dropIfExists('school_powers');
    }
}
