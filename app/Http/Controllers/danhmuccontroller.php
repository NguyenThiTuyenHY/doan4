<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\sanpham;
use Illuminate\Pagination\Paginator;

class danhmuccontroller extends Controller
{
    public function getdanhsach(){
    	$danhmuc = danhmuc::all();
    	return view('admin.danhmuc.danhsach',['dm'=>$danhmuc]);
    }
    public function insertdanhsach($tendm){
    	try{
    		$danhmuc = new danhmuc;
    		$danhmuc->tendm = $tendm;
    		if($danhmuc->save()){
    			echo true;
    		}
    		else {
    			echo false;
    		}
    	}
    	catch(Excaption $e){
    		echo $e->Message();
    	}
    }
    public function editdanhsach($id,$tendm){
    	try{
    		$danhmuc = danhmuc::find($id);
    		$danhmuc->tendm = $tendm;
            // $danhmuc = DB::update('update danhmuc set danhmuc.ten = ? where danhmuc.id =?',[$tendm,$id]);
    		if($danhmuc->save()){ 
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
    public function deletedanhsach($id){
    	try{
    		$danhmuc = danhmuc::find($id);
    		if($danhmuc->delete()){
    			echo true;
    		}
    		else {
    			echo false;
    		}
    	}
    	catch(Excaption $e){
    		echo $e->Message();
    	}
    }
    public function getdanhmucuser($id){
        $sps = DB::table('danhmuc')
        ->join('loaidanhmuc', 'loaidanhmuc.iddm', '=', 'danhmuc.id')
        ->join('sanpham', 'loaidanhmuc.id', '=', 'sanpham.idl')->where('danhmuc.id',$id)->select('sanpham.*')->paginate(5);
        $dm = danhmuc::find($id);
        // $dm = DB::table('sanpham')
        // ->join('loaidanhmuc', 'loaidanhmuc.id', '=', 'sanpham.idl')
        // ->join('danhmuc', 'danhmuc.id', '=', 'loaidanhmuc.iddm')
        // ->where('danhmuc.id',$id)
        // ->orderByRaw('sanpham.rate DESC')->get();
        // // ->paginate(15);
        return view('user.pages.danhmuc',["sps"=>$sps,"dm"=>$dm]);
    }
}
