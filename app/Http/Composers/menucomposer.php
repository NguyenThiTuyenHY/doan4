<?php 
namespace App\Http\Composers;
use Illuminate\View\View;
use App\danhmuc;
use App\loaidanhmuc;
use App\theloai;
use App\loaitheloai;

class menucomposer{
	public function composer(){
		return view()->with('danhmuc',danhmuc::all());
	}
}