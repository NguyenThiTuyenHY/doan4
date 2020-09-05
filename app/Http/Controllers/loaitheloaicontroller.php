<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loaitheloai;
use App\theloai;

class loaitheloaicontroller extends Controller
{
    public function getdanhsach(){
    	$loai = Loaitheloai::all();
    	$theloai = theloai::all();
    	return view('admin.loaitheloai.danhsach',['ls'=>$loai,'th'=>$theloai]);
    }
    public function insertdanhsach($ten,$iddm){
        try{
            $loai = new Loaitheloai;
            $loai->tenltl = $ten;
            $loai->idtl = $iddm;
            if($loai->save()){
                echo true;
            }
            else {
                echo false;
            }
        }   
        catch(Excaption $e){
            echo false;
        }     
    }
    public function editdanhsach($id,$ten,$iddm){
        try{
            $loai = Loaitheloai::find($id);
            $loai->tenltl = $ten;
            $loai->idtl = $iddm;
            if($loai->save()){
                return array('success'=>true,'ten'=>$ten,'tendm'=>$loai->theloai->tentl);
            }
            else {
                return array('success'=>'false');
            }
        }
        catch(Excaption $e){
            echo array('success'=>'false');
        }
    }
    public function deletedanhsach($id){
        try{
            $loai= Loaitheloai::find($id);
            if($loai->delete()){
                echo true;
            }
            else {
                echo false;
            }
        }
        catch(Excaption $e){
            echo false;
        }
    }
}
