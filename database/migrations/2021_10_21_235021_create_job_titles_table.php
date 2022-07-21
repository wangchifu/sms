<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('semester')->nullable();
            $table->string('school_code')->nullable(); //gsuite帶出學校代碼 即 cloudschool 帶出的 school_no
            $table->string('school_name')->nullable(); //gsuite帶出學校名稱
            $table->string('schools')->nullable(); //gsuite帶出學校群組
            $table->string('kind')->nullable(); //gsuite帶出教職員、學生
            $table->string('title_kind')->nullable(); //cloudschool 帶出 title_kind
            $table->string('title')->nullable(); //gsuite帶出職稱 即 cloudschool帶出的title_name
            $table->string('cloudschool_username')->nullable(); //cloudschool帳號
            $table->string('role')->nullable(); //cloudschool 帶出 role
            $table->string('group')->nullable(); //cloudschool 帶出 group
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
        Schema::dropIfExists('job_titles');
    }
}
