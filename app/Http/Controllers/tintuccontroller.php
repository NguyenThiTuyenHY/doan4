<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tintuc;
use App\theloai;
use App\loaitheloai;
use Illuminate\Support\Facades\DB;

class tintuccontroller extends Controller
{
    public function getdanhsach(){
        $tts = tintuc::all();
    	return view('admin.tintuc.danhsach',['tts'=>$tts]);
    }
     public function getdanhsachgiaiphap(){
        $tts = tintuc::all();
        return view('admin.giaphap.danhsach',['tts'=>$tts]);
    }
     public function getdanhsachdichvu(){
        $tts = tintuc::all();
        return view('admin.dichvu.danhsach',['tts'=>$tts]);
    }
    public function themdanhsach(){
        $ths = theloai::all();
    	return view('admin.tintuc.them',['ths'=>$ths]);
    }
    public function chuoi1($a,$array){
    	
    	return $bs;
    }
    public function insertdanhsach(Request $req){
    	$this->validate($req,[
    		'txttd'=>'required',
    		'txtha'=>'required',
            'txttt'=>'required' 	
        ],[
    		'txttd.required'=>'Không để trống tiêu đề',
    		'txtha.required'=>'Không để trống hình ảnh',
            'txttt.required'=>'Không để trống tóm tắt'
    	]);
        $file = $req->file('txtha');
        $duoi = $file->getClientOriginalExtension('txtha');
        $duoi1 = strtoupper($duoi);  
        if($duoi1=='JPG'||$duoi1=='PNG'||$duoi1=='GIF'){
            $tintuc = new tintuc;
            $tintuc->tieude = $req->txttd;
            $tintuc->tomtat = $req->txttt;
            $tintuc->chitiet = $req->input('txtnd');
            $file = $req->file('txtha');
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('upload/tintuc',$Hinh);
            $tintuc->hinhanh  = $Hinh;
            $tintuc->idltl=$req->txtl;
            $tintuc->ngaydang = date("Y/m/d");
            $tintuc->luotxem=0;
            $tintuc->save();
            return redirect('admin/tintuc/them')->with('thongbao','thêm thành công');
        }
        else {
            return redirect('admin/tintuc/them')->with('thongbao1','file ảnh định dạng không đúng');
        }       
    }
    public function gettt($id){
        $tt = tintuc::where('id',$id)->first()->toArray();
        return $tt;
    }
    public function suadanhsach($id){
        $ths = theloai::all();
        $ls = loaitheloai::all();
        $tt = tintuc::where('id',$id)->first()->toArray();
        $idtt = tintuc::where('id',$id)->first()->loaitheloai->theloai->id;
        return view('admin.tintuc.sua',['ths'=>$ths,'ls'=>$ls,'tt'=>$tt,'idtt'=>$idtt]);
    }
    public function thuquanhe($id){
       $tt = tintuc::where('id',$id)->first();
       return $tt->loai->tenl;
    }
    public function delete($id){
        $tt = tintuc::find($id);
        if($tt->delete())
            return true;
        else
            return false;
    }
    public function editdanhsach(Request $req){
        // $this->validate($req,[
        //     'txttd'=>'required',
        //     'txtha'=>'required',
        //     'txttt'=>'required'     
        // ],[
        //     'txttd.required'=>'Không để trống tiêu đề',
        //     'txtha.required'=>'Không để trống hình ảnh',
        //     'txttt.required'=>'Không để trống tóm tắt'
        // ]);
        $file = $req->file('txtha');
        $tintuc = tintuc::find($req->txtid);
        $xx = $tintuc->hinhanh;
        if($req->hasFile('txtha')){
            $file = $req->file('txtha');
            $duoi = $file->getClientOriginalExtension('txtha');
            $duoi1 = strtoupper($duoi);  
            if($duoi1=='JPG'||$duoi1=='PNG'||$duoi1=='GIF'){
                $tintuc->tieude = $req->txttd;
                $tintuc->tomtat = $req->txttt;
                $tintuc->chitiet = $req->input('txtnd');
                $file = $req->file('txtha');
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                    while (file_exists("upload/tintuc/".$Hinh)) {
                        $Hinh = str_random(4)."_".$name;
                    }
                $file->move('upload/tintuc',$Hinh);
                $tintuc->hinhanh  = $Hinh;
                $tintuc->idltl=$req->txtl;
                $tintuc->ngaydang = date("Y/m/d");
                $tintuc->luotxem=0;
            }
            // else{
            //     return redirect('admin/tintuc/them')->with('thongbao1','file anh khong dung');
            // }
        }
        else{
            $tintuc->tieude = $req->txttd;
            $tintuc->tomtat = $req->txttt;
            $tintuc->chitiet = $req->input('txtnd');
            $tintuc->idltl=$req->txtl;
            $tintuc->ngaydang = date("Y/m/d");           
        }
        if($tintuc->save()){
            return redirect('admin/tintuc/sua/'.$req->txtid)->with('thongbao','sửa thành công');
        }
        else{
            return redirect('admin/tintuc/sua/'.$req->txtid)->with('thongbao','sửa thất bại');
        }        
        // if($req->file('txtha')!=null){
        //     echo "co file";
        // }
        // else{
        //     echo "khong file";
        // }
        // return $req;
    }
    public function gettintucuser($id){
        $tintuc = tintuc::where('idltl',$id)->orderBy('created_at','DESC')->paginate(5);
        return view('user.pages.tintuc',['tt'=>$tintuc]);
    }
    public function deletetintuc($id){
        $tintuc = tintuc::find($id);
        if($tintuc == null){
             return  response()->json(['success'=>true]);
        }
        else{
            if($tintuc->delete()){
                return  response()->json(['success'=>true]);
            }
            else{
                return response()->json(['success'=>false]);
            }
        }      
    }
    public function getchitiettintucuser($id,$idpt){
        $tintuc = tintuc::find($idpt);
        return view('user.pages.chitiettintuc',['tt'=>$tintuc]);
    }
    public function tangview($id){
        $tintuc = tintuc::find($id);
        $tintuc->luotxem = $tintuc->luotxem +1;
        if($tintuc->save()){
            return response()->json(['success'=>true]);
        }
        else {
           return response()->json(['success'=>false]);
        }
    }
}
