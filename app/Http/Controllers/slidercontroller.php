<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slider;

class slidercontroller extends Controller
{
    public function getdanhsach(){
    	$slider = slider::all();
    	return view('admin.slider.danhsach',['sliders'=>$slider]);
    }
}
