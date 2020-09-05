<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Response;

class usercontroller extends Controller
{
    public function getdn(){
    	return view('admin.login.login');
    }
    public function postdn(Request $req){
    	$this->validate($req,[
    		'txtemail'=>'required',
    		'txtpass'=>'required|min:3|max:32'
    	],[
    		'txtemail.required'=>'Không để trống email',
    		'txtpass.required'=>'Không để trống mật khẩu',
    		'txtpass.min'=>'Mật khẩu trong khoảng 3 đến 32 ký tự ',
    		'txtpass.max'=>'Mật khẩu trong khoảng 3 đến 32 ký tự '
    	]);
    	if(Auth::attempt(['email'=>$req->txtemail,'password'=>$req->txtpass,'chucvu'=>0])){   		
            // view()->share('user_login',Auth::user());
            session()->put('user_login',auth::user());
            return redirect('admin/thongke/bangdieukhien');
            // return var_dump(session('user_login'));
    	}
    	else {
    		return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
    	}
    }
    public function logout(){
    	Auth::logout();
        session()->forget('user_login');
    	return redirect('admin/dangnhap');
    }
    public function getdanhsach(){
        $us =  user::all();
        return view('admin.user.danhsach',['us'=>$us]);
    }
    public function gethoso(){
        $us =  user::find(1);
        return view('admin.user.hoso',['us'=>$us]);
    }
    public function getthietlap($id){
        $u = user::find($id);
        return view('admin.user.thietlap',['u'=>$u,'ma'=>$id]);
    }
    public function suathietlap(Request $req){
        if($req->hasFile('txthinh')){
            $user = new user;
            $file = $req->file('txthinh');
            $jpg = $file->getClientOriginalExtension('txthinh');
            if((($jpg == "jpg") || ($jpg == "png") || ($jpg == "gif"))){
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                while (file_exists("upload/tintuc/".$Hinh)) {
                    $Hinh = str_random(4)."_".$name;
                }
                $file->move('upload/user',$Hinh);
                $user = user::find($req->txtid);
                $Hinhcu = $user->hinhanh;
                $user->name = $req->txtten;
                $user->ngaysinh = $req->txtns;
                $user->tentaikhoan = $req->txttentk;
                $user->diachi = $req->txtdiachi;
                $user->hinhanh = $Hinh;
                $user->sdt =  $req->txtsdt;
                $use->save();
                return response()->json(['success'=>true, 'thongbao'=> $name]);
                // if($user->save()){
                //     return response()->json(['success'=>true, 'thongbao'=> 'Thiết lập thành công']);
                // }
                // else{
                //     return response()->json(['success'=>false, 'thongbao'=> 'Thiết lập thất bại']);
                // }
            }
            else{
                return response()->json(['success'=>false, 'thongbao'=> 'Định dạng ảnh không đúng. Chỉ nhận đuôi png, jpg, gif']);
            }
        }
       else {
           $user = user::find($req->txtid);
           $user->namw = $req->txtten;
           $user->ngaysinh = $req->txtns;
           $user->tentaikhoan = $req->txttentk;
           $user->diachi = $req->txtdiachi;
           $user->sdt =  $req->txtsdt;
           if($user->save()){
                return response()->json(['success'=>true, 'thongbao'=> 'Thiết lập thành công']);
            }
            else{
                return response()->json(['success'=>false, 'thongbao'=> 'Thiết lập thất bại']);
            }
       }
    }
    public function changestate($id,$tt){
        if($tt==1){
            $utt = 2;
        }
        if($tt==2){
            $utt = 1;
        }
        $u = user::find($id);
        $u->trangthai = $utt;
        if($u->save()){
            echo true;
        }
        else{
            echo false;
        }
    }
    public function getdangnhapuser(Request $req){
        if(Auth::attempt(['email'=>$req->txtemail,'password'=>$req->txtpass])){
            if(Auth::user()->trangthai == 1){
                session()->put('co_login', Auth::user());
                return response()->json(['success' => true,'thongbao' => 'Đăng nhập thành công']);
            }
            else{
                return response()->json(['success' => false,'thongbao' => 'Tại khoản hiện tại của bạn đang bị khóa']);
            }
        }
        else{
            return response()->json(['success'=>false,'thongbao'=>'Đăng nhập thất bại','txtmk'=>$req->txtemail]);
        }
    }
    public function gethosouser($id){
        $us =  user::find($id);
        return view('user.pages.hoso',['us'=>$us]);
    }
    public function logoutuser(){
        Auth::logout();
        session()->forget('co_login');
        return redirect('user/trangchu');
    }
    public function getformdangnhap(Request $req){
        return view('user.pages.dangnhap',['url'=>$req->txturl]);
    }
    public function getthietlapuser(Request $req){
        $id = $req->session()->get('co_login')->id;
        $user = user::find($id);
        return view('user.pages.thietlap',['u'=>$user]);
    }
    public function ktemail($email){
        $khs = user::all();
        $kq = true;
        foreach ($khs as $kh) {
            if($kh->email == $email){
                $kq = false;
            }
        }
        return $kq;
    }
    public function dangkyuser(Request $req){
        if(strlen($req->input('g-recaptcha-response'))!=null){
            if($this->ktemail($req->email)!=true){
                return redirect('/user/dangky')->with('thongbao','Email đã được sử dụng!! Bạn nhập email khác');
            }
            else{
                if($req->pass == $req->cpass){
                    $file = $req->file("hinhanh");
                    $duoi = $file->getClientOriginalExtension('hinhanh');
                    if($duoi == 'jpg' || $duoi == 'png' || $duoi == 'gif'){
                        $kh = new user;
                        $kh->name = $req->name;
                        $kh->email = $req->email;
                        $kh->ngaysinh = $req->ngaysinh;
                        $kh->password = bcrypt($req->pass);
                        $kh->tentaikhoan = $req->tentaikhoan;
                        $kh->diachi = $req->diachi;
                        $kh->chucvu = 1;
                        $kh->trangthai = 1;
                        $name = $file->getClientOriginalName();
                        $Hinh = str_random(4)."_".$name;
                        while (file_exists("upload/tintuc/".$Hinh)) {
                            $Hinh = str_random(4)."_".$name;
                        }
                        $file->move('upload/user',$Hinh);
                        $kh->hinhanh = $Hinh;
                        $kh->sdt = $req->sdt;
                        $kh->remember_token = $req->input('_token');
                        if($kh->save()){
                            return redirect('/user/dangky')->with('thongbao','Đăng ký tài khoản thành công vui lòng đăng nhập');
                        }
                        else {
                            return redirect('/user/dangky')->with('thongbao','Đăng ký thất bại vui lòng đăng ký lại');
                        }
                    }                  
                }
                else{
                    return redirect('/user/dangky')->with('thongbao','Mật khẩu và nhập lại mật khẩu không trùng nhau');
                }
            }
        }
        else{
            return redirect('/user/dangky')->with('thongbao','Bạn chưa check captcha');
        }
    }
}
