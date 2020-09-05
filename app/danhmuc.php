<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class danhmuc extends Model
{
    protected $table="danhmuc";
    public function loaidanhmuc(){
    	return $this->hasMany("App\loaidanhmuc","iddm",'id');
    }
    public function phanloai(){
    	return $this->hasManyThrough("App\loaidanhmuc","App\phanloai","iddm","idl","id","id");
    }
    public function sanpham(){
    	return $this->hasManyThrough("App\loaidanhmuc","App\phanloai","App\sanpham","iddm","idl","idpl","id","id","id");
    }
}
