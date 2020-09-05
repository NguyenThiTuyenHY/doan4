<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phanloai extends Model
{
    protected $table = "phanloai";
    public function theloai(){
    	return $this->hasManyThrough('App\theloai','App\phanloai','idtl','idl','id');
    }
    public function loaidanhmuc(){
    	return $this->belongsTo('App\loaidanhmuc','idl','id');
    }
    public function sanpham(){
    	return $this->hasMany('App\sanpham','idpl','id');
    }
}
