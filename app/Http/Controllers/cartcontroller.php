<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sanpham;
use App\user;
use App\donhang;
use App\chitietdonhang;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;

class cartcontroller extends Controller
{
    public function getcart(Request $request){
    	$cart = \Cart::getContent();
    	$totalquantity = \Cart::getTotalQuantity();
    	$subtotal = \Cart::getSubTotal();
    	return view('user.pages.cart',['cart'=>$cart,'totalquantity'=>$totalquantity, 'subtotal' =>$subtotal]);
    }
    public function addcart($id,Request $request){
    	try{
    		$sp = sanpham::find($id);
    		\Cart::add(array(
    			'id' => $sp->id,
    			'name' => $sp->tensp,
    			'price' => $sp->gia,
    			'quantity' => 1,
    			'attributes' => array('img'=>$sp->hinhanh,'quantity'=>$sp->soluong)
    		));
    		return response()->json(['success'=>true]);
    	}
    	catch(Excaption $e){
    		return response()->json(['success'=>false]);
    	}
    }
    public function remove($id){
    	try{
    		\Cart::remove($id);
    		$subtotal = \Cart::getSubTotal();
    		return response()->json(['success'=>true,'subtotalsua'=>$subtotal]);
    	}
    	catch(Excaption $e){
    		return response()->json(['success'=>false]);
    	}
    }
    public function update($id,$sl){
    	try{
			// $cart = \Cart::get($id);
			// \Cart::remove($id);
			// \Cart::add(array(
   //  			'id' => $cart->id,
   //  			'name' => $cart->name,
   //  			'price' => $cart->price,
   //  			'quantity' => $cart->quantity,
   //  			'attributes' => array('img'=>$cart->attributes->img,'quantity'=>$cart->attributes->quantity)
   //  		));
    		$sls = $sl-\Cart::get($id)->quantity;
    		\Cart::update($id, array(
    			'quantity' => $sls,
    		));
    		$subtotal = \Cart::getSubTotal();
    		$totalproduct = \Cart::get($id)->price * $sl;
    		return response()->json(['success'=>true,'subtotalxoa'=>$subtotal,'totalproduct'=>$totalproduct]);
    	}
    	catch(Excaption $e){
    		return response()->json(['success'=>false]);
    	}
    }
    public function dathang(){
        $cart = $cart = \Cart::getContent();
        $subtotal = \Cart::getSubTotal();
    	return view('user.pages.dathang',['cart'=>$cart,'subtotal'=>$subtotal]);
    }
    public function postdathang(Request $req){
        try{
            $cart = \Cart::getContent();
            $donhang = new donhang;
            $donhang->iduser = $req->txtid;
            $donhang->hoten = $req->txtname;
            $donhang->noigiao = $req->txtnoigiao;
            $donhang->sodienthoai = $req->txtsdt;
            $donhang->tinhtrang = 1;
            $donhang->ngaydat = date("Y/m/d");
            $donhang->thanhtien = \Cart::getSubTotal();
            if($donhang->save()){
                $a = DB::table('donhang')->select('id')->orderByRaw('ngaydat DESC')->skip(0)->take(1)->get();
                foreach ($cart as $car) {
                    $chitietdonhang = new chitietdonhang;
                    $chitietdonhang->iddh = $a;
                    $chitietdonhang->idsp = $car->id;
                    $chitietdonhang->donhang = $car->price;
                    $chitietdonhang->soluong = $car->quantity;
                    $chitietdonhang->save();
                }
            }           
            \Cart::clear();
            return response()->json(['success'=>true]);
        }
        catch(Excaption $e){
            return response()->json(['success'=>false]);
        }
    }
    // public function taoma(){
        
    // }
    public function postdathang1($txtid,$txtname,$txtnoigiao,$txtsdt,$txtemail){
        try{
            $cart = \Cart::getContent();
            $donhang = new donhang;
            $donhang->iduser = $txtid;
            $donhang->hoten = $txtname;
            $donhang->noigiao = $txtnoigiao;
            $donhang->sodienthoai = $txtsdt;
            $donhang->tinhtrang = 1;
            $donhang->ngaydat = date("Y/m/d");
            $donhang->thanhtien = \Cart::getSubTotal();
            // $a = count(donhang::all());
            if($donhang->save()){
                $a = DB::table('donhang')->skip(count(donhang::all())-1)->take(1)->get();;
                foreach ($cart as $car) {
                    $chitietdonhang = new chitietdonhang;
                    $chitietdonhang->iddh = $a[0]->id;
                    $chitietdonhang->idsp = $car->id;
                    $chitietdonhang->dongia = $car->price;
                    $chitietdonhang->soluong = $car->quantity;
                    $chitietdonhang->save();
                }
            }            
            $data = array('name'=>$txtname,'subtotal'=> \Cart::getSubTotal(),'orderdetail'=>\Cart::getContent());
            // Mail::to($txtemail)->send(new SendMail($data,$orderdetail));
            // Mail::send('user.pages.mail',$data,function($message){
            //     $message->from('nguyenthituyenntthy@gmail.com','Website giai phap mang LAN Sao Bắc Đẩu');
            //     $message->to($txtemail,$txtname)->subject('Đơn hàng mới từ website giải pháp mạng LAN Sao Bắc Đẩu');
            // });
            Mail::to($txtemail)->send(new SendMail($data));
            \Cart::clear();
            return response()->json(['success'=>true]);
        }
        catch(Excaption $e){
            return response()->json(['success'=>false]);
        }
    }

    public function theodoidonhang(Request $req){
        $iduser = $req->session()->get('co_login')->id;
        $donhang = donhang::where('iduser',$iduser)->paginate(5);
        return view('user.pages.theodoidonhang',['donhangs'=>$donhang]);
    }
    public function chuyenhoanthanh($id){
        $donhang = donhang::find($id);
        $donhang->tinhtrang = 4;
        if($donhang->save()){
            return response()->json(['success'=>true]);
        }
        else{
            return response()->json(['success'=>false]);
        }
    }
    public function layslsp($id,$sl){
        $slht = sanpham::find($id)->soluong;
        if($sl<1){
            return response()->json(['success'=>false,'thongbao'=>'Số lượng nhập vào ít nhất là 1']);
        }
        else {
            if($sl<=$slht){
                return response()->json(['success'=>true]);
            }
            else{
                return response()->json(['success'=>false,'thongbao'=>'Số lượng quá lớn!!!, Số lượng hiện có: '.$slht]);
            }  
        }
    }
}
