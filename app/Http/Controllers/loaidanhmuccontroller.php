<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\sanpham;

class loaidanhmuccontroller extends Controller
{
    public function getdanhsach(){
    	$ldm = loaidanhmuc::orderBy('id','DESC')->get();
    	$dm = danhmuc::all();
    	return view('admin.loaidanhmuc.danhsach',['ldm'=>$ldm,'dm'=>$dm]);
    }
    public function insertdanhsach($ten,$iddm){
        try{
            $loai = new loaidanhmuc;
            $loai->tenldm = $ten;
            $loai->iddm = $iddm;
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
            $loai = loaidanhmuc::find($id);
            $loai->tenldm = $ten;
            $loai->iddm = $iddm;
            if($loai->save()){
                return array('success'=>true,'ten'=>$ten,'tendm'=>$loai->danhmuc->tendm);
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
            $loai=loaidanhmuc::find($id);
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
