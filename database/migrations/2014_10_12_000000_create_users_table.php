<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable(); //gsuite帶出uid
            $table->string('edu_key')->unique(); //gsuite及cloudschool帶出edu_key
            $table->string('line_key')->nullable();//line notify權杖
            $table->string('name'); //姓名
            $table->string('sex')->nullable(); //性別
            $table->string('email')->nullable(); //email
            $table->string('username')->nullable(); //gsuite帳號
            $table->string('password')->nullable();
            $table->tinyInteger('order_by')->nullable(); //教職員排序
            $table->string('login_type'); //gsuite local
            $table->string('local_module')->nullable(); //哪一個模組要用的本機帳號
            $table->tinyInteger('system_admin')->nullable(); //系統管理
            $table->tinyInteger('disable')->nullable(); //停用
            $table->unsignedInteger('disabled_by')->nullable(); //停用
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
        Schema::dropIfExists('users');
    }
}
