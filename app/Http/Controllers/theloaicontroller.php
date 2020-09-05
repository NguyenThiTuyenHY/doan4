<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
class theloaicontroller extends Controller
{
    public function getdanhsach(){
    	$theloai = theloai::all(); 
    	return view('admin.theloai.danhsach',['tls'=>$theloai]);
    }
}
