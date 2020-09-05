<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaitheloai extends Model
{
    protected $table = "loaitheloai";
    public function theloai(){
    	return $this->belongsTo('App\theloai','idtl','id');
    }
    public function tintuc(){
    	return $this->hasMany('App\tintuc','idltl','id');
    }
}
