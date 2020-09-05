<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hoadon;
use App\chitiethoadon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\sanpham;
use App\Exports\ExcelExport;
use Excel;

class hoadoncontroller extends Controller
{
	public function getdanhsach(){
		$hoadon = hoadon::orderByRaw('created_at DESC')->paginate(5);
    	return view('admin.hoadon.danhsach',['hds'=>$hoadon]);
	}
	public function insertdanhsach(Request $req,$array){
		try{
			$hoadon = new hoadon; 	
			$a = 0;
			$b = explode(',', $array);
			$ds=[];
			for($i=0;$i<count($b);$i+=3){
				array_push($ds, ['id'=>$b[$i],'dongia'=>$b[($i+1)],'soluong'=>$b[($i+2)]]);
			}
			array_push($ds,['id'=>$req->txtsanpham,'dongia'=>$req->txtdongia,'soluong'=>$req->txtsoluong]);
			foreach ($ds as $s) {
				$a = $a + $s['dongia'] * $s['soluong'];	
			}		
			$hoadon->idncc = $req->txtncc;
			$hoadon->tendonvi = $req->txttenncc;
			$hoadon->diachi = $req->txtdiachincc;
			$hoadon->sodienthoai = $req->txtsdtncc;
			$hoadon->ngaynhap = date("Y/m/d");
			$hoadon->thanhtien = $a;
			if($hoadon->save()){
				$mahd = DB::table('hoadon')->select('id')->orderByRaw('created_at DESC')->skip(0)->take(1)->get()->toArray();				
				foreach ($ds as $s) {
					$chitiethoadon = new chitiethoadon;
					$chitiethoadon->idhd = $mahd[0]->id;
					$chitiethoadon->idsp = $s["id"];
					$chitiethoadon->dongia = $s["dongia"];
					$chitiethoadon->soluong = $s["soluong"];
					sanpham::find($s["id"])->soluong = sanpham::find($s["id"])->soluong + $s["soluong"];
					$chitiethoadon->save();
				}
			}
			return response()->json(['success'=>true]);						
		}
		catch(Excaption $e){
			return response()->json(['success'=>false]);
		}
	}
	public function deletedanhsach($id,$kieu){
		try{
			$hoadon = hoadon::find($id);
			if($hoadon->delete()){
				foreach ($hoadon->chitiethoadon as $ct) {
					$hoadon->chitiethoadon->delete();
				}
				return response()->json(['success'=>true]);
			}
			else {
				return response()->json(['success'=>false]);
			}
		}
		catch(Excaption $e){
			return response()->json(['success'=>false]);
		}
	}
	public function inhoadon($id){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($id));
		return $pdf->stream();
	}
	public function print_order_convert($id){
		$hd = hoadon::find($id);
		$time = explode('-',$hd->ngaynhap);
		$str ="<style>body{font-family: DejaVu Sans;} 
		table {
			border-collapse: collapse;
			width: 100%;
		}
		.table-bordered td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		} </style>";
		$str .= '<h4><center>Ngày '.$time[2].' tháng '.$time[1].'  năm '.$time[0].'</center></h4>';
		$str .= '<hr>';
		$str .= 'Đơn vị bán hàng: '.$hd->tendonvi ."<br>";
		$str .= 'Địa chỉ: ' .$hd->diachi ."<br>";
		$str .= 'Số điện thoại: '.$hd->sodienthoai ."<br>";
		$str .= '<hr>';
		$str .= 'Đơn vị mua hàng: Website bán thiết bị mạng LAN Sao Thiên Vương<br>';
		$str .= 'Địa chỉ:  188/7 Thành Thái, Phường 12, Quận 10, TP.HCM<br>';
		$str .= 'Số điện thoại: +84 917 39 7766<br>';
		$str .= '					<h4 class="text-center"><center>Chi tiết hóa đơn</center></h4>';
		$str .= '					<table class="table table-bordered">';
		$str .= '						<thead>';
		$str .= '							<tr>';
		$str .= '								<th><center>STT</center></th>';
		$str .= '								<th><center>Sản phẩm</center></th>';
		$str .= '								<th><center>Đơn giá</center></th>';
		$str .= '								<th><center>Số lượng</center></th>';
		$str .= '								<th><center>Thành tiền</center></th>';
		$str .= '							</tr>';
		$str .= '						</thead>';
		$str .= '						<tbody>';
									$t = 1;
									foreach($hd->chitiethoadon as $ct){
		$str .= '							<tr>';
		$str .= '								<td><center>' .$t++.'</center></td>';
		$str .= '								<td>'.$ct->sanpham->tensp.'</td>';
		$str .= '								<td><center>'.number_format($ct->dongia) .'</center></td>';
		$str .= '								<td><center>'.$ct->soluong.'</center></td>';
		$str .= '								<td>'.number_format($ct->dongia * $ct->soluong).'</center></td>';
		$str .= '							</tr>';
									}
		$str .= '							<tr>';
		$str .= '								<td colspan="4">Tổng tiền: </td>';
		$str .= '								<td>' .number_format($hd->thanhtien).' VNĐ</td>';
		$str .= '							</tr>';
		$str .= '						</tbody>';
		$str .= '					</table>';
		$str .= '							<br>';
		$str .= '							<br>';
		$str .= '					<table class="table">';
		$str .= '							<tr>';
		$str .= '								<td><center>Người mua hàng <br><small>(Ký, ghi rõ học và tên)</small></center></td>';
		$str .= '								<td><center>Người bán hàng <br><small>(Ký, ghi rõ học và tên)</small></center></td>';
		$str .= '								<td><center>Thủ trưởng đơn vị<br><small>(Ký, ghi rõ học và tên)</small></center></td>';
		$str .= '							</tr>';
		$str .= '					</table>';
		return $str;
	}
	public function export_csv(){
        return Excel::download(new ExcelExport , 'xuatexcel.xlsx');
    }
    public function insertchitiethoadon($array,$id){
    	try{
    		$ds = explode(',',$array);
    		$dsk = [];
    		$s = 0;
    		for($i =0;$i<count($ds);$i+=3){
    			array_push($dsk,["id"=>$ds[$i],"gia"=>$ds[$i+1],"sl"=>$ds[$i+2]]);
    		}
    		foreach ($dsk as $ct){
    			$cthd = new chitiethoadon; 
    			$cthd->idhd = $id;
    			$cthd->idsp = $ct["id"];
    			$cthd->dongia = $ct["gia"];
    			$cthd->soluong = $ct["sl"];
    			$s = $ct["gia"] * $ct["sl"];
    			$cthd->save();
    		}
    		$hoadon = hoadon::find($id);
    		$hoadon->thanhtien = $hoadon->thanhtien + $s;
    		$hoadon->save();
    		return response()->json(["success"=>true,"thongbao"=>$dsk]);
    	}
    	catch(Excaption $e){
    		return response()->json(["success"=>false]);
    	}
    }
}
