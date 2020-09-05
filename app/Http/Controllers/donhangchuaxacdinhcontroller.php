<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\sanpham;
use App\donhang;

class donhangchuaxacdinhcontroller extends Controller
{
    public function getdanhsach($id){
    	$donhang = donhang::where('tinhtrang','=',$id)->orderBy('created_at','desc')->paginate(5);
    	return view('admin.donhang.donhangchuaxacdinh',['donhangs'=>$donhang]);
    }
    public function getonedonhang($id){
    	$donhang = donhang::find($id);
    	return view('admin.donhang.xuathoadon',['donhang'=>$donhang]);
    }
    public function chuyenhuy($id){
    	$donhang = donhang::find($id);
    	$donhang->tinhtrang = 5;
    	if($donhang->save()){
    		return Response()->json(['success'=>true]);
    	}
    	else {
    		return Response()->json(['success'=>false]);
    	}
    }
    public function chuyenxacnhan($id){
    	$donhang = donhang::find($id);
    	$donhang->tinhtrang = 2;
    	if($donhang->save()){
    		return Response()->json(['success'=>true]);
    	}
    	else {
    		return Response()->json(['success'=>false]);
    	}
    }
    public function chuyendanggiao(Request $req){
    	try{
    		$donhang = donhang::find($req->txtid);
    		$donhang->tinhtrang = 3;
    		$donhang->tenshipper = $req->txtnameshipper;
    		$donhang->sodienthoaishipper = $req->txtphoneshipper;
    		$a = 0;
    		foreach ($donhang->chitietdonhang as $ct) {
    			$sp = sanpham::find($ct->idsp);
    			$sp->soluong = $sp->soluong - $ct->soluong;
                $sp->rate += $ct->soluong; 
    			$sp->save();
    		}
    		if($donhang->save()){
    			return Response()->json(['success'=>true]);
    		}
    		else {
    			return Response()->json(['success'=>false]);
    		}
    	}
    	catch(Excaption $e){
    		return Response()->json(['success'=>false]);
    	}
    }
}
