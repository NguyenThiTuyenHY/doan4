<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaidanhmuc extends Model
{
    protected $table="loaidanhmuc";
    public function danhmuc(){
    	return $this->belongsTo('App\danhmuc',"iddm","id");
    }
    public function phanloai(){
    	return $this->hasMany('App\phanloai','idl','id');
    }
    public function sanpham(){
    	return $this->hasManyThrough('App\phanloai','App\sanpham','idl','idpl','id','id');
    }
}
