<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semester');
            $table->string('name'); //姓名
            $table->string('sex'); //性別
            $table->string('birthday')->nullable(); //生日
            $table->string('pwd')->nullable(); //密碼
            $table->string('parents_telephone')->nullable(); //爸媽電話
            $table->string('student_sn'); //學號
            $table->string('student_year'); //年級
            $table->string('student_class'); //班級
            $table->tinyInteger('num'); //座號
            $table->tinyInteger('disable')->nullable();
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
        Schema::dropIfExists('students');
    }
}
