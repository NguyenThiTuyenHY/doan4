<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\sanpham;
use App\user;
use App\theloai;
use App\loaitheloai;
use App\tintuc;
use App\rate;
use App\nhacungcap;
use App\hoadon;
use Illuminate\Support\Facades\DB;

class thongkecontroller extends Controller
{
    public function getdanhsach(){
    	$dms = danhmuc::all()->toArray();
    	$ldms = loaidanhmuc::all()->toArray();
    	$pls = phanloai::all()->toArray();
    	$sp = sanpham::all()->toArray();
    	$tls= theloai::all()->toArray();
    	$ltls = loaitheloai::all()->toArray();
    	$us = user::all()->toArray();
    	$tts = tintuc::all()->toArray();
        $rate = rate::all()->toArray();
        $nhacungcap = nhacungcap::all()->toArray();
        $donhangchuaxacnhan = DB::table('donhang')->where('tinhtrang','1')->count();
        $donhangxacnhan = DB::table('donhang')->where('tinhtrang','2')->count();
        $donhangdanggiao = DB::table('donhang')->where('tinhtrang','3')->count();
        $donhanghoanthanh = DB::table('donhang')->where('tinhtrang','4')->count();
        $donhanghuy = DB::table('donhang')->where('tinhtrang','5')->count();
        $time = getdate();
        $dssdh= array();
        for($i = 1; $i<=12; $i++) {
            if($i<=9){
                $namthang = $time["year"]."-0".$i."-";
            }            
            else{
                $namthang = $time["year"]."-".$i."-";
            }
            $str = "SELECT * FROM donhang WHERE ngaydat LIKE '".$namthang."%' AND tinhtrang !=5";
            $sdh = DB::select($str);
            $sdh1 = count($sdh);
            array_push($dssdh, $sdh1);
        }
        $dsdoanhthu= array();
        for($i = 1; $i<=12; $i++) {
            if($i<=9){
                $namthang = $time["year"]."-0".$i."-";
            }            
            else{
                $namthang = $time["year"]."-".$i."-";
            }
            $str = "SELECT sum(thanhtien) as tongtien FROM `donhang` WHERE ngaydat LIKE '".$namthang."%' AND tinhtrang =4";
            $tiendh = DB::select($str);
            if($tiendh == NULL){
                $tiendh = 0;
            }
            array_push($dsdoanhthu, $tiendh[0]->tongtien);
        }
        $str3 = "SELECT sum(thanhtien) as tongtien FROM `donhang` WHERE ngaydat LIKE '".$time["year"]."%' AND tinhtrang =4";
        $doanhnam = DB::select($str3);       
        $doanhthunam = $doanhnam[0]->tongtien;
        // var_dump($doanhthunam);
        $str4 = "SELECT count(id) as sohoadon FROM `donhang` WHERE ngaydat LIKE '".$time["year"]."%' AND tinhtrang !=5";
        $sohoadonnam = DB::select($str4);  
        $sohoadontheonam = $sohoadonnam[0]->sohoadon;
        // var_dump($sohoadontheonam);
        $sohoadon = DB::table('hoadon')->count();
        $dsncc =[];
        foreach ($nhacungcap as $ncc){
            $shd = DB::table('hoadon')->where('idncc',$ncc['id'])->count('id');
            $hdnccs = hoadon::where('idncc',$ncc['id'])->get();
            $slspncc =0;
            foreach ($hdnccs as $hdncc) {
                foreach ($hdncc->chitiethoadon as $ct) {
                    $slspncc = $slspncc + $ct->soluong;
                }
            }
            array_push($dsncc,['ncc'=>$ncc["tenncc"],'solan'=>$shd,'sosp'=>$slspncc]);
        }
        $spsh = DB::table('sanpham')->select('sanpham.*')->where([
            ['soluong','<=','5'],
            ['soluong','>','0'],
        ])->get();
        $sph = sanpham::where('soluong','0')->get();
        $sputs = sanpham::all();
        $dsut = [];
        foreach ($sputs as $sput) {
            $rate = rate::where('idsp',$sput->id) ->avg('rate');
            if($rate> 3){
                array_push($dsut,array('sput'=>$sput,'rate'=>$rate));
            }
        }
        $dshuy = [];
        $dsuser = user::where('chucvu',1)->get();
        // return var_dump($dsuser);
        foreach ($dsuser as $ds) {
            $solanhuy = DB::table('donhang')->where([['tinhtrang','=',5],['iduser',$ds->id]])->count();
            if($solanhuy>=3){
                array_push($dshuy,array('id'=>$ds->id,'name'=>$ds->tentaikhoan,'trangthai'=>$ds->trangthai,'solanhuy'=>$solanhuy));
            }
        }

        $dssaothaprate = rate::where('rate','<','3')->get();
    	return view('admin.thongke.bangdieukhien',['sps'=>$sp,'uss'=>$us,'dms'=>$dms,'ldms'=>$ldms,'pls'=>$pls,'tls'=>$tls,'ltls'=>$ltls,'tts'=>$tts,'rates'=>$rate,'nhacungcaps'=>$nhacungcap,'donhangchuaxacnhan'=>$donhangchuaxacnhan, 'donhangxacnhan'=>$donhangxacnhan,'donhangdanggiao'=>$donhangdanggiao,'donhanghoanthanh'=>$donhanghoanthanh,'donhanghuy'=>$donhanghuy,'dssdh'=>$dssdh,'dsdoanhthu'=>$dsdoanhthu,'doanhthunam'=>$doanhthunam,'sohoadontheonam'=>$sohoadontheonam,'sohoadon'=>$sohoadon,'dsncc'=>$dsncc,'spsh'=>$spsh,'sph'=>$sph,'dsut'=>$dsut,'dssaothaprate'=>$dssaothaprate,'dshuy'=>$dshuy]);
    }
}
