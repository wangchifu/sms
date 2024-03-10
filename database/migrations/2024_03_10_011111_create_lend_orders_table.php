<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lend_orders', function (Blueprint $table) {
            $table->bigIncrements('id');   
            $table->string('lend_item_id');         
            $table->unsignedInteger('num');//
            $table->string('lend_date');
            $table->string('lend_section');
            $table->string('back_date');
            $table->string('back_section');
            $table->string('user_id');
            $table->string('owner_user_id');
            $table->text('ps')->nullable();
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
        Schema::dropIfExists('lend_orders');
    }
}
