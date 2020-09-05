<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
    protected $table = "theloai";
    public function loaitheloai(){
    	return $this->hasMany('App\loaitheloai','idtl','id');
    }
}
