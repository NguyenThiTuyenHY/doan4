<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Donhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang',function($table){
            $table->increments('id');
            $table->integer('iduser')->nullable();
            $table->string('hoten');
            $table->string('noigiao');
            $table->string('sodienthoai');
            $table->integer('tinhtrang');
            $table->string('tenshipper')->nullable();
            $table->string('sodienthoaishipper')->nullable();
            $table->date('ngaydat');
            $table->integer('thanhtien');
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
        Schema::drop('donhang');
    }
}
