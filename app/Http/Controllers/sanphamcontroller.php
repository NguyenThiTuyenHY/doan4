<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc;
use App\loaidanhmuc;
use App\phanloai;
use App\sanpham;
use App\rate;
use Illuminate\Support\Facades\DB;

class sanphamcontroller extends Controller
{
    public function getdanhsach(){
    	$danhmuc = danhmuc::all();
        $sanpham = sanpham::all();
    	return view('admin.sanpham.danhsach',['sps'=>$sanpham,'dms'=>$danhmuc]);
    }
    public function insertdanhsach(Request $req){
    	try{
            $this->validate($req,[
                'txtha'=>'required',
                'txttsp'=>'',
                'txtgia'=>'',
                'txtnd'=>'required',
                'txtldm'=>'required||max:2||',
                'txttt'=>'required'
            ],[
                'txtha.required'=>'Không để hình ảnh trống',
                'txtnd.required'=>'Không để nội dung trống',
                'txtldm.required'=>'Không để loại danh mục trống',
                'txtldm.max'=>'Phải chọn danh mục rồi chọn loại danh mục',
                'txttt.required'=>'Không để trống tóm tắt'
            ]);
    		$sp = new sanpham;
    		$file = $req->file('txtha');
            $a = $file->getClientOriginalExtension('txtha');
            $duoi = strtoupper($a);
            if($duoi == "JPG" || $duoi == "GIF" || $duoi == "PNG"){
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                while (file_exists("upload/sanpham/".$Hinh)) {
                    $Hinh = str_random(4)."_".$name;
                }
                $file->move('upload\sanpham',$Hinh);
                $sp->tensp = $req->txttsp;
                $sp->hinhanh = $Hinh;
                $sp->gia = $req->txtgia;
                $sp->soluong = $req->txtsl;
                $sp->chitiet = $req->input('txtnd');
                $sp->rate = 0;
                $sp->idl = $req->txtldm;
                $sp->idpl = $req->txttb;
                $sp->tomtat = $req->txttt;
                if($sp->save())
                    return redirect('admin/sanpham/them')->with('thongbao','thêm thành công');
                else
                    return redirect('admin/sanpham/them')->with('thongbao','thêm thất bại');
            }
            else {
                return redirect('admin/sanpham/them')->with('thongbao','File ảnh không đúng. chỉ chứa đuôi .jpg, .png, .gif');
            }
    		
    	}
    	catch(Excaption $e){
    		return $e;
    	}
    }
    public function getsanpham($idsp){
        $sp = sanpham::find($idsp)->toArray();
        return $sp;
    }
    public function themdanhsach(){
        $danhmuc = danhmuc::all();
        return view('admin.sanpham.them',['dms'=>$danhmuc]);
    }
    public function suadanhsach($id){
        $sps = sanpham::find($id);
        $danhmuc = danhmuc::all();
        $loaidanhmuc = loaidanhmuc::all();
        $phanloai = phanloai::all();
        return view('admin.sanpham.sua',['dms'=>$danhmuc,'sps'=>$sps,'ldms'=>$loaidanhmuc,'pls'=>$phanloai]);
    }
    public function capnhatdanhsach(Request $req){
        try{
            // $this->validate($req,[
            //     'txtha'=>'required',
            //     'txttsp'=>'',
            //     'txtgia'=>'',
            //     'txtnd'=>'required',
            //     'txtldm'=>'required||max:2||',
            //     'txttt'=>'required'
            // ],[
            //     'txtha.required'=>'Không để hình ảnh trống',
            //     'txtnd.required'=>'Không để nội dung trống',
            //     'txtldm.required'=>'Không để loại danh mục trống',
            //     'txtldm.max'=>'Phải chọn danh mục rồi chọn loại danh mục',
            //     'txttt.required'=>'Không để trống tóm tắt'
            // ]);
            $file = $req->file('txtha');
            if($req->hasFile('txtha')){
                $sp = sanpham::find($req->txtid);
                $file = $req->file('txtha');
                $a = $file->getClientOriginalExtension('txtha');
                $duoi = strtoupper($a);
                if($duoi == "JPG" || $duoi == "GIF" || $duoi == "PNG"){
                    $name = $file->getClientOriginalName();
                    $Hinh = str_random(4)."_".$name;
                    while (file_exists("upload/sanpham/".$Hinh)) {
                        $Hinh = str_random(4)."_".$name;
                    }
                    $xx = $sp->hinhanh;
                    $file->move('upload\sanpham',$Hinh);
                    $sp->tensp = $req->txttsp;
                    $sp->hinhanh = $Hinh;
                    $sp->gia = $req->txtgia;
                    $sp->soluong = $req->txtsl;
                    $sp->chitiet = $req->input('txtnd');
                    $sp->idl = $req->txtldm;
                    $sp->idpl = $req->txttb;
                    $sp->tomtat = $req->txttt;
                    // unlink('upload/sanpham/'.$xx);
                    
                }
                else{
                     return redirect('admin/sanpham/sua/'.$req->txtid)->with('thongbao','File ảnh không đúng. chỉ chứa đuôi .jpg, .png, .gif');
                }
            }
            else{
                $sp = sanpham::find($req->txtid);
                $sp->tensp = $req->txttsp;
                $sp->gia = $req->txtgia;
                $sp->soluong = $req->txtsl;
                $sp->chitiet = $req->input('txtnd');
                $sp->idl = $req->txtldm;
                $sp->idpl = $req->txttb;
                $sp->tomtat = $req->txttt;
            }
            if($sp->save())
                return redirect('admin/sanpham/sua/'.$req->txtid)->with('thongbao','sửa  thành công');
            else
                return redirect('admin/sanpham/sua/'.$req->txtid)->with('thongbao','sửa thất bại');
        }
        catch(Excaption $e){
            return $e;
        }
    }

    public function deletesanpham($id){
        $sp = sanpham::find($id);
        if($sp==null){
             response()->json(['success'=>true]);
        }
        else{
            if(DB::table('sanpham')->find($id)->delete()){
                response()->json(['success'=>true]);
            }
            else {
                return response()->json(['success'=>false]);
            }
        }
    }
    // TRANG CHU

    public function getsanphamtrangchu(){
        // SEO
        // $meta_desc = "Trang chủ - Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $meta_keywords = "Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $meta_title =  "Trang chủ - Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $url_canonical = $_SERVER['HTTP_REFERER'];
        $spms = DB::table('sanpham')
        ->select('sanpham.*')
        ->orderByRaw('created_at DESC')
        ->where('soluong','>',0)
        ->skip(0)->take(4)->get();
        $sphs = DB::table('sanpham')
        ->select('sanpham.*')
        ->orderByRaw('rate DESC')
        ->where('soluong','>',0)
        ->skip(0)->take(4)->get();
        $slider = DB::table('slider')->select('id','hinhanh')->orderByRaw('id DESC')->skip(1)->take(4)->get();
        $stt = DB::table('slider')->select('id','hinhanh')->orderByRaw('id DESC')->skip(0)->take(1)->get();
        return view('user.pages.trangchu',['spms'=>$spms,'sphs'=>$sphs,'sliders'=>$slider,'stt'=>$stt]);
    }

    public function getsanphamchitietsanpham($id){
        $sp = sanpham::find($id);
        // $meta_desc = $sp->tensp ."- Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $meta_keywords = "Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $meta_title = $sp->tensp ."- Website bán thiết bị mạng LAN sao Bắc Đẩu";
        // $url_canonical = $_SERVER['HTTP_REFERER'];
        $splq = DB::table('sanpham')->select('sanpham.*')
        ->where([['idl',$sp->idl],['id','!=',$sp->id],['soluong','>',0]])
        ->orderByRaw('created_at DESC')
        ->skip(0)->take(9)->get();
        $rateavg = DB::table('rating')->where([['idsp',$id],['trangthai',1]])->avg('rate');
        $rate = rate::where([['idsp',$id],['trangthai',1]])->orderByRaw('created_at DESC')->get();
        return view('user.pages.chitietsanpham',['sp'=>$sp,'splq'=>$splq,'rates'=>$rate,'rateavg'=>$rateavg]); 
        // foreach($rate as $rt){
        //     var_dump($rt->sanpham) ."<br>";
        // }
    }
    public function getdanhmucuser($id){
        $sps = DB::table('danhmuc')
        ->join('loaidanhmuc', 'loaidanhmuc.iddm', '=', 'danhmuc.id')
        ->join('sanpham', 'loaidanhmuc.id', '=', 'sanpham.idl')->where([['danhmuc.id',$id],['soluong','>',0]])->select('sanpham.*')->paginate(5);
        $dm = danhmuc::find($id);
        // $dm = DB::table('sanpham')
        // ->join('loaidanhmuc', 'loaidanhmuc.id', '=', 'sanpham.idl')
        // ->join('danhmuc', 'danhmuc.id', '=', 'loaidanhmuc.iddm')
        // ->where('danhmuc.id',$id)
        // ->orderByRaw('sanpham.rate DESC')->get();
        // // ->paginate(15);
        return view('user.pages.danhmuc',["sps"=>$sps,"dm"=>$dm]);
    }
    public function getloaidanhmucuser($id){
        $sps = DB::table('sanpham')
        ->join('loaidanhmuc', 'loaidanhmuc.id', '=', 'sanpham.idl')
        ->where([['loaidanhmuc.id',$id],['soluong','>',0]])->select('sanpham.*')->paginate(5);
        $ldm = loaidanhmuc::find($id);
        return view('user.pages.loaidanhmuc',["sps"=>$sps,"ldm"=>$ldm]);
    }
    public function getphanloaiuser($id){
        $sps = DB::table('sanpham')
        ->join('phanloai', 'phanloai.id', '=', 'sanpham.idpl')
        ->where([['phanloai.id',$id],['soluong','>',0]])->select('sanpham.*')->paginate(5);
        $pl = phanloai::find($id);
        return view('user.pages.loaidanhmuc',["sps"=>$sps,"pl"=>$pl]);
    }
    public function timkiem(Request $req){
        $a = $req->txtsearch;
        $sps = sanpham::where([['tensp','like','%'.$a.'%'],['soluong','>',0]])->paginate(5);
        return view('user.pages.timkiem',["sps"=>$sps,'tukhoa'=>$a]);
    }
}
