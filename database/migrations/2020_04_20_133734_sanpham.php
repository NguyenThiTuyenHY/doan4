<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham',function($table){
            $table->increments('id');
            $table->string('tensp');
            $table->string('hinhanh');
            $table->integer('soluong');
            $table->integer('gia');
            $table->longText('tomtat');
            $table->longText('chitiet');           
            $table->integer('idl')->unsigned();
            $table->foreign('idl')->references('id')->on('loaidanhmuc')->onDelete('cascade');
            $table->integer('idpl')->unsigned()->nullable();
            $table->foreign('idpl')->references('id')->on('phanloai')->onDelete('cascade');
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
        Schema::drop('sanpham');
    }
}
