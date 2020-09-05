<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tintuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintuc',function($table){
            $table->increments('id');
            $table->string('tieude');
            $table->string('hinhanh');
            $table->longText('tomtat');
            $table->longText('chitiet');
            $table->date('ngaydang');
            $table->integer('luotxem');            
            $table->integer('idltl')->unsigned();
            $table->foreign('idltl')->references('id')->on('loaitheloai')->onDelete('cascade');
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
        Schema::drop('tintuc');
    }
}
