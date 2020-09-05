<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitiethoadon extends Model
{
    protected $table ="chitiethoadon";
    public function hoadon()
    {
    	return $this->belongsTo('App\hoadon','idhd','id');
    }
    public function sanpham(){
    	return $this->belongsTo('App\sanpham','idsp','id');
    }
}
