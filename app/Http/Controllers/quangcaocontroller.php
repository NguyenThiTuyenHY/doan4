<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quangcao;

class quangcaocontroller extends Controller
{
    public function getdanhsach(){
    	$qcs = quangcao::all();
    	return view('admin.quangcao.danhsach',['qcs'=>$qcs]);
    }
    public function themquangcao(Request $req){
    	$file = $req->file('txthinhanh');
    	$duoi = $file->getClientOriginalExtension('txthinhanh'); 
    	if($duoi == 'jpg' || $duoi == 'png' || $duoi=='gif'){
    		$name = $file->getClientOriginalName();
    		$Hinh = str_random(4)."_".$name;
    		while (file_exists("upload/quangcao/".$Hinh)) {
    			$Hinh = str_random(4)."_".$name;
    		}
    		$file->move('upload/quangcao/',$Hinh);
    		$quangcao = new quangcao;
    		$quangcao->hinhanh = $Hinh;
    		$quangcao->tieude = $req->txttieude;
    		if($quangcao->save()){
    			return response()->json(['success'=>true,'thongbao'=>'Thêm quảng cáo thành công','ds'=>$quangcao]);
    		}
    		else{
    			return  response()->json(['success'=>false,'thongbao'=>'Thêm quáng cáo thất bại']);
    		}
    	}
    	return response()->json(['success'=>false,'thongbao'=>'Hình ảnh chỉ nhận các file có đuôi là jpg, png, gif']);
    }
    public function xoaquangcao($id){
    	$quangcao = quangcao::find($id);
    	if($quangcao->delete()){
    		return response()->json(['success'=>true]);
    	}
    	else {
    		return  response()->json(['success'=>false]);
    	}
    }
    public function suaquangcao($id,$tieude){
    	$quangcao = quangcao::find($id);
    	$quangcao->tieude = $tieude;
    	if($quangcao->save()){
    		return response()->json(['success'=>true]);
    	}
    	else {
    		return  response()->json(['success'=>false]);
    	}
    }
}
