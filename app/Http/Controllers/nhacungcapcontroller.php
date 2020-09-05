<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhacungcap;
use Illuminate\Support\Facades\DB;

class nhacungcapcontroller extends Controller
{
    public function getdanhsach(){
    	$nccs = nhacungcap::all();
    	return view('admin.nhacungcap.danhsach',['nccs'=>$nccs]);
    }
    public function them(Request $req){
        $hs = new nhacungcap;
        $hs->tenncc = $req->ten_nha_cung_cap;
        $hs->diachi = $req->dia_chi;
        $hs->sodienthoai = $req->dien_thoai;
        $hs->email = $req->email;
        if($hs->save()){
            return response()->json(['success'=>'Thêm thành công','danhsach'=>DB::table('nhacungcap')->orderByRaw('id DESC')->skip(0)->take(1)->get()]);           
        }
        else{
            return response()->json(['errors'=>'Lỗi']);
        }
    }
    public function sua(Request $req){
        $result = DB::table('nhacungcap')->where('id', $req->ma_nha_cung_cap)->update(['tenncc' => $req->ten_nha_cung_cap,'diachi' => $req->dia_chi,'sodienthoai' => $req->dien_thoai,'email' => $req->email]);
        if($result){
            return response()->json(['success'=>'Sửa thành công','id'=>$req->ma_nha_cung_cap,'tenncc'=> $req->ten_nha_cung_cap,'diachi'=>$req->dia_chi,'sodienthoai'=>$req->dien_thoai,'email'=>$req->email]);    
        }
        else{
            return response()->json(['errors'=>'Lỗi']);
        }
    }
    public function xoa($id){
        $hs = DB::table('nhacungcap')->where('id',$id);
        if($hs->delete()){
            echo true;
        }
        else{
            echo false;
        }
    }
}
