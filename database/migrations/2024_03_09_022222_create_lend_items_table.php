<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lend_items', function (Blueprint $table) {
            $table->bigIncrements('id');   
            $table->string('lend_class_id');         
            $table->string('name');//
            $table->unsignedInteger('num');//
            $table->string('user_id');
            $table->tinyInteger('enable')->nullable();//啟用
            $table->text('ps')->nullable();
            $table->string('lend_sections')->nullable();
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
        Schema::dropIfExists('lend_items');
    }
}
