<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLHmail;

class lienhecontroller extends Controller
{
    public function lienhe(){
    	return view('user.pages.lienhe');
    }
    public function guilienhe(Request $req){
    	try{
    		Mail::to('nguyenthituyenntthy@gmail.com')->send(new SendLHmail($req));
    		return Response()->json(['success'=>true]);
    	}
    	catch(Excaption $e){
    		return Response()->json(['success'=>false]);
    	}
    }
}
