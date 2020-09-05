<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chitietdonhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang',function($table){
            $table->increments('id');
            $table->integer('iddh')->unsigned();
            $table->foreign('iddh')->references('id')->on('donhang')->onDelete('cascade');
            $table->integer('idsp')->unsigned();
            $table->foreign('idsp')->references('id')->on('sanpham')->onDelete('cascade');
            $table->integer('dongia');
            $table->integer('soluong');
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
        Schema::drop('chitietdonhang');
    }
}
