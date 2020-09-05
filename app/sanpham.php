<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    protected $table = "sanpham";
    public function phanloai(){
    	return $this->belongsTo('App\phanloai','idpl','id');
    }
    public function loaidanhmuc(){
    	return $this->belongsTo('App\loaidanhmuc','idl','id');
    }
    public function theloai(){
    	return $this->hasManyThrough('App\theloai','App\loaidanhmuc','idtl','idl','id');
    }
    public function rating(){
        return $this->hasMany('App\rate','idsp','id');
    }
    public function chitietdonhang(){
        return $this->hasOne('App\chitietdonhang','idsp','id');
    }
    public function chitiethoadon(){
        return $this->hasOne('App\chitiethoadon','idsp','id');
    }
}
