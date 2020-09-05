<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tintuc extends Model
{
    protected $table = "tintuc";
    public function loaitheloai(){
    	return $this->belongsTo('App\loaitheloai','idltl','id');
    }
    public function theloai(){
    	return $this->hasManyThough('App\theloai','App\loaitheloai','idtl','idltl','id');
    }
}
