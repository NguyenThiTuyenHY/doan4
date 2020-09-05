<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rate;
use App\sanpham;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ratecontroller extends Controller
{
    public function guicmt(Request $req){
    	$rating = new rate;
    	$erorrs= $req->validate([
    		'txtbinhluan' => 'required',
    	],[
    		'txtbinhluan.required'=>'Không để trống bình luận'
    	]);
    	$rating->binhluan = $req->txtbinhluan;
    	$rating->rate = $req->txtrate;
        $rating->trangthai = 1;
    	$rating->idsp = $req->txtidsp;
    	$rating->iduser = $req->txtiduser;
    	if($rating->save()){
            $rateavg = DB::table('rating')->where('idsp',$req->txtidsp)->avg('rate');
    		return response()->json(['success'=>true,'thongbao'=>'Thêm bình luận thành công','binhluan'=>$rating->binhluan,'hinhanh'=>$rating->user->hinhanh,'ten'=>$rating->user->name, 'rate'=>$rating->rate, 'avg' => $rateavg, 'ngay' => date('d-m-Y')]);
    	} 
    	else{
    		return response()->json(['success'=>false,'thongbao'=>'Thêm thất bại','erorrs'=>$erorrs]);
    	}
    }
    public function getdanhsachadmin(){
        $sps = sanpham::paginate(5);
        return view('admin.rate.danhsach',['sps'=>$sps]);
    }
    public function chuyentt($id,$tt){
        if($tt == 1){
            $chuyen = 2;
        }
        else{
            $chuyen = 1;
        }
        $result = DB::table('rating')->where('id', $id)->update(['trangthai'=> $chuyen]);
        if($result){
            return response()->json(['success'=>true,'thongbao'=>'Chuyển trạng thái thành công','tt'=>$chuyen]);
        }
        else {
            response()->json(['success'=>false,'thongbao'=>'Chuyển trạng thái thất bại']);
        }
    }
}
