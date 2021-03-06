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
            $table->string('edu_key')->nullable(); //gsuite及cloudschool帶出edu_key
            $table->string('name'); //姓名
            $table->string('email')->nullable(); //email
            $table->string('username')->nullable(); //gsuite帳號
            $table->string('password')->nullable();
            $table->string('current_school_code')->nullable(); //gsuite帶出學校代碼 即 cloudschool 帶出的 school_no
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
