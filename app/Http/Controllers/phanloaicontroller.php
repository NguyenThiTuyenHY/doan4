<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\sanpham;

class phanloaicontroller extends Controller
{
    public function getdanhsach(){
    	$pls = phanloai::all();
        $ls = loaidanhmuc::all();
    	return view('admin.phanloai.danhsach',['pls'=>$pls,'ls'=>$ls]);
    }
    public function insertdanhsach($ten,$idldm){
        try{
            $pl = new phanloai;
            $pl->tenpl = $ten;
            $pl->idl = $idldm;
            if($pl->save()){
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
            $pl = phanloai::find($id);
            $pl->tenpl = $ten;
            $pl->idl = $iddm;
            if($pl->save()){
                return array('success'=>true,'ten'=>$ten,'tenldm'=>$pl->loaidanhmuc->tenldm);
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
            $pl=phanloai::find($id);
            if($pl->delete()){
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
