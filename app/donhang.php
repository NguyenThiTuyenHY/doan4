<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    protected $table="donhang";
    public function chitietdonhang(){
    	return $this->hasMany('App\chitietdonhang','iddh','id');
    }
    public function user(){
    	return $this->hasOne('App\User','iduser','id');
    }
}
