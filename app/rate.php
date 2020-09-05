<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    protected $table = "rating";
    public function user(){
    	return $this->belongsTo('App\User','iduser','id');
    }
    public function sanpham(){
    	return $this->belongsTo('App\sanpham','idsp','id');
    }
}
