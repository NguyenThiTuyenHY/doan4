<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\theloai;
use App\loaitheloai;
use App\tintuc;
use App\sanpham;
use App\nhacungcap;
use Illuminate\Support\Facades\Response;

class ajaxcontroller extends Controller
{
    //Sua trong danh muc
    public function getloaidm($ten){
    	$dm = danhmuc::all();
    	$a="";
    	foreach ($dm as $item){
    		echo $item->ten. ' ' .$ten;
    		if($item->ten == $ten){
    			$a .=  "<option value='".$item->id."' selected='selected'>".$item->tendm."</option>";
    		}
    		else {
    			$a .=  "<option value='".$item->id."'>".$item->tendm."</option>";
    		}
    	}
    	echo $a;
    }
    public function getloaidm1($id){
        $ldms = loaidanhmuc::all();
        $a ="";
        foreach ($ldms as $ldm) {
            if($ldm->danhmuc->id==$id){
                $a .=  "<option value='".$ldm->id."'>".$ldm->tenldm."</option>";
            }
        }
        echo $a;
    }
    public function getthietbi($id){
        $tts = phanloai::all();
        $a ="";
        $stt = 0;
        foreach ($tts as $tt) {
            if($tt->loaidanhmuc->id == $id){
                $a .=  "<option value='".$tt->id."'>".$tt->tenpl."</option>";
                $stt ++;
            }
        }
        $kq = array('ds'=>$a,'stt'=>$stt);
        return $kq;
    }
    public function getdanhmuc(){
        $dms = danhmuc::all();
        $a ="";
        foreach ($dms as $dm) {
            $a .=  "<option value='".$dm->id."'>".$dm->tendm."</option>";
        }
        echo $a;
    }
    public function suasp($idtb,$idl){       
        $iddm=0;
        $a ="";$b="";$c="";
        $tts = thietbi::all();
        if($idtb!=0){
            foreach ($tts as $tt) {
                if($tt->id == $idtb){
                    $a .=  "<option value='".$tt->id."' selected='selected'>".$tt->ten."</option>";
                }
                else {
                    $a .=  "<option value='".$tt->id."'>".$tt->ten."</option>";
                }
            }
        }
        echo $a;
        // $ldms = loaidanhmuc::find('id',$)        
        $dms = danhmuc::all();
        $d=0;
        // $dmos = danhmuc::select('SELECT danhmuc.id FROM danhmuc inner join loaidanhmuc on danhmuc.id = loaidanhmuc.iddm where loaidanhmuc.id = 1 LIMIT 0,1');
        // foreach ($dmos as $dmo) {
        //     echo 'ID theloai'. $dmo->id;
        // }
        // foreach ($dms as $dm) {
        //     if($dm->id == $){
        //         $a .=  "<option value='".$dm->id."'>".$dm->ten."</option>";
        //     }
        // }
        // echo  $idldm;
        // echo var_dump($dms);
        foreach ($dms as $dm) {
            if($dm->loaidanhmuc->id == $idl){
                var_dump($dm->loaidanhmuc->id);
                $b .=  "<option value='".$dm->id."' selected='selected'>".$dm->ten."</option>";
                $iddm = $dm->id;
            }
            else {
                $b .=  "<option value='".$dm->id."'".$dm->ten."</option>";
            }
        }
        echo $b;
        // $ldms = loaidanhmuc::find('iddm',$iddm)->get();
        // foreach ($ldms as $ldm) {
        //     if($ldm->id == $idl){
        //         $c .=  "<option value='".$ldm->id."' selected='selected'>".$ldm->ten."</option>";
        //         $iddm = $dm->id;
        //     }
        //     else {
        //         $c .=  "<option value='".$ldm->id."'".$ldm->ten."</option>";
        //     }
        // }
        // return array('dsdm'=>$b,'dsldm'=>$c,'dstb'=>$a);
    }
    public function gettheloai($ten){
        $theloai = theloai::all();
        $a="";
        foreach ($theloai as $item){
            if($item->tentl == $ten){
                $a .=  "<option value='".$item->id."' selected='selected'>".$item->tentl."</option>";
            }
            else {
                $a .=  "<option value='".$item->id."'>".$item->tentl."</option>";
            }
        }
        echo $a;
    }
    public function getloaithem($idth){
        $ls = loaitheloai::all();
        $a="";
        foreach ($ls as $l){
            if($l->theloai->id == $idth){
                $a .=  "<option value='".$l->id."'>".$l->tenltl."</option>";
            }
        }
        echo $a;
    }
    public function getloaisua($idtt){
        $l = loaitheloai::all();
        $a="";
        foreach ($theloai as $item){
            if($item->tentl == $ten){
                $a .=  "<option value='".$item->id."' selected='selected'>".$item->tenltl."</option>";
            }
            else {
                $a .=  "<option value='".$item->id."'>".$item->tenltl."</option>";
            }
        }
        echo $a;
    }
    public function getdanhmuctheopl($tenldm){
        $l = loaidanhmuc::all();
        $a ="";
        foreach ($l as $item) {
            if($item->tenldm == $tenldm){
                $a .=  "<option value='".$item->id."' selected='selected'>".$item->tenldm."</option>";
            }
            else {
                $a .=  "<option value='".$item->id."'>".$item->tenldm."</option>";
            }
        }
        echo $a;
    }
    public function getsaphamhoadon(){
        $sanphams = sanpham::all();
        $a="";
        foreach($sanphams as $sp){
            $a.= "<option value='".$sp->id."'>".$sp->tensp."</option>";
        }
        echo $a;
    }
    public function getnhacungcaphoadon(){
        $nccs = nhacungcap::all();
        $a ="";
        foreach($nccs as $ncc){
            $a.= "<option value='".$ncc->id."'>".$ncc->tenncc."</option>";
        }
        echo $a;
    }
    public function getnhacungcaphoadontheomancc($id){
        $ncc = nhacungcap::find($id);
        return response()->json(['ncc'=>$ncc]);
    }
}
