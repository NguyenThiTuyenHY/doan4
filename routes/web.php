<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/dangnhap','usercontroller@getdn');

Route::post('admin/postdangnhap',['as'=>'admin/postdangnhap','uses'=>'usercontroller@postdn']);

Route::get('admin/logout','usercontroller@logout');


Route::group(['prefix'=>'admin', 'middleware'=>'adminlogin'],function(){

	Route::group(['prefix'=>'danhmuc'],function(){
		Route::get('danhsach','danhmuccontroller@getdanhsach');
		Route::get('them/{tendm}', 'danhmuccontroller@insertdanhsach');
		Route::get('sua/{id}/{tendm}', 'danhmuccontroller@editdanhsach');
		Route::get('xoa/{id}', 'danhmuccontroller@deletedanhsach');
	});

	Route::group(['prefix'=>'loaidanhmuc'],function(){
		Route::get('danhsach', 'loaidanhmuccontroller@getdanhsach');
		Route::get('them/{ten}/{iddm}', 'loaidanhmuccontroller@insertdanhsach');
		Route::get('sua/{id}/{ten}/{iddm}', 'loaidanhmuccontroller@editdanhsach');
		Route::get('xoa/{id}', 'loaidanhmuccontroller@deletedanhsach');
	});

	Route::group(['prefix'=>'phanloai'],function(){
		Route::get('danhsach', 'phanloaicontroller@getdanhsach');
		Route::get('them/{ten}/{iddm}', 'phanloaicontroller@insertdanhsach');
		Route::get('sua/{id}/{ten}/{iddm}', 'phanloaicontroller@editdanhsach');
		Route::get('xoa/{id}', 'phanloaicontroller@deletedanhsach');
	});

	Route::group(['prefix'=>'sanpham'],function(){
		Route::get('danhsach', 'sanphamcontroller@getdanhsach');
		Route::get('them', 'sanphamcontroller@themdanhsach');
		Route::post('postthemsp',['as'=>'postthemsp','uses'=>'sanphamcontroller@insertdanhsach']);
		Route::get('sua/{id}', 'sanphamcontroller@suadanhsach');
		// Route::post('postsuasp',['as'=>'postsuasp','uses'=>'sanphamcontroller@editdanhsach']);
		Route::post('postsuasp','sanphamcontroller@capnhatdanhsach');
		Route::get('xoa/{id}','sanphamcontroller@deletesanpham');
		Route::get('danhsach/{idsp}', 'sanphamcontroller@getsanpham');
	});

	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach', 'theloaicontroller@getdanhsach');
	});

	Route::group(['prefix'=>'loaitheloai'],function(){
		Route::get('danhsach', 'loaitheloaicontroller@getdanhsach');
		Route::get('them/{ten}/{iddm}', 'loaitheloaicontroller@insertdanhsach');
		Route::get('sua/{id}/{ten}/{iddm}', 'loaitheloaicontroller@editdanhsach');
		Route::get('xoa/{id}', 'loaitheloaicontroller@deletedanhsach');	
	});

	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach', 'tintuccontroller@getdanhsach');
		Route::get('them', 'tintuccontroller@themdanhsach');
		Route::post('postthem',['as'=>'postthem','uses'=>'tintuccontroller@insertdanhsach']);
		Route::get('gettt/{id}', 'tintuccontroller@gettt');
		Route::get('sua/{id}', 'tintuccontroller@suadanhsach');
		Route::post('postsuatt',['as'=>'postsuatt','uses'=>'tintuccontroller@editdanhsach']);
		Route::get('xoa/{id}','tintuccontroller@deletetintuc');
	});

	Route::group(['prefix'=>'giaiphap'],function(){
		Route::get('danhsach', 'tintuccontroller@getdanhsachgiaiphap');
	});

	Route::group(['prefix'=>'dichvu'],function(){
		Route::get('danhsach', 'tintuccontroller@getdanhsachdichvu');
	});

	Route::group(['prefix'=>'khachhang'],function(){
		Route::get('danhsach', 'usercontroller@getdanhsach');
		Route::get('hoso', 'usercontroller@gethoso');
		Route::get('thietlap/{id}', 'usercontroller@getthietlap');
		Route::post('suathietlap', 'usercontroller@suathietlap')->name('khachhang.suathietlap');
		Route::get('trangthai/{id}/{tt}','usercontroller@changestate');
	});

	Route::group(['prefix'=>'donhang'],function(){
		Route::get('danhsach/trangthai={id}', 'donhangchuaxacdinhcontroller@getdanhsach');
		Route::get('intrang/{id}','donhangchuaxacdinhcontroller@getonedonhang');
		Route::get('danhsach/tinhtrangchuyenhuy/{id}','donhangchuaxacdinhcontroller@chuyenhuy');
		Route::get('danhsach/tinhtrangchuyenxacnhan/{id}','donhangchuaxacdinhcontroller@chuyenxacnhan');
		Route::get('danhsach/tinhtrangdanggiao','donhangchuaxacdinhcontroller@chuyendanggiao');
	});

	Route::group(['prefix'=>'hoadon'],function(){
		Route::get('danhsach','hoadoncontroller@getdanhsach');
		Route::get('themhoadon/{ds?}','hoadoncontroller@insertdanhsach');
		Route::get('xoahoadon/{id}/{kieu}','hoadoncontroller@deletedanhsach');
		Route::get('inhoadon/{id}','hoadoncontroller@inhoadon');
		Route::post('export-csv','hoadoncontroller@export_csv')->name('hoadon.xuatexcel');
		Route::get('insertchitiethoadon/{array}/{id}','hoadoncontroller@insertchitiethoadon')->name('insertchitiethoadon');
	});

	Route::group(['prefix'=>'rate'],function(){
		Route::get('danhsach','ratecontroller@getdanhsachadmin');
		Route::get('chuyentt/{id}/{tt}','ratecontroller@chuyentt');
	});

	Route::group(['prefix'=>'slider'],function(){
		Route::get('danhsach','slidercontroller@getdanhsach');
	});

	Route::group(['prefix'=>'ajax'],function(){
		Route::get('loaidanhmuc/{ten}', 'ajaxcontroller@getloaidm');
		Route::get('danhmuc/{id}', 'ajaxcontroller@getloaidm1');
		Route::get('theloai/{id}','ajaxcontroller@getthietbi');
		Route::get('danhmuc','ajaxcontroller@getdanhmuc');
		Route::get('laydanhmuc/{idtb}/{idl}','ajaxcontroller@suasp');
		Route::get('laytheloai/{ten}','ajaxcontroller@gettheloai');
		Route::get('tintucgetloaithem/{idth}','ajaxcontroller@getloaithem');
		Route::get('getdanhmuctheopl/{tenldm}','ajaxcontroller@getdanhmuctheopl');
		Route::get('sanphamtheohoadon','ajaxcontroller@getsaphamhoadon');
		Route::get('nhacungcaptheohoadon','ajaxcontroller@getnhacungcaphoadon');
		Route::get('nhacungcaptheohoadonmancc/{id}','ajaxcontroller@getnhacungcaphoadontheomancc');
	});

	Route::group(['prefix'=>'thongke'],function(){
		Route::get('bangdieukhien', 'thongkecontroller@getdanhsach');
	});

	Route::group(['prefix'=>'nhacungcap'],function(){
		Route::get('danhsach', 'nhacungcapcontroller@getdanhsach');
		Route::any('sua',['as'=>'nhacungcapsua','uses'=>'nhacungcapcontroller@sua']);
        Route::any('them',['as'=>'nhacungcapthem','uses'=>'nhacungcapcontroller@them']);
        Route::get('xoa/{id}','nhacungcapcontroller@xoa');
	});

	Route::group(['prefix'=>'quangcao'],function(){
		Route::get('danhsach', 'quangcaocontroller@getdanhsach');
		Route::post('them','quangcaocontroller@themquangcao')->name('quangcao.them');
		Route::get('xoaquangcao/{id}','quangcaocontroller@xoaquangcao');
		Route::get('suaquangcao/{id}/{tieude}','quangcaocontroller@suaquangcao');
	});
});

Route::get('','sanphamcontroller@getsanphamtrangchu');

Route::group(['prefix'=>'user'],function(){
	Route::get('trangchu',['as'=>'trangchu','uses'=>'sanphamcontroller@getsanphamtrangchu']);

	Route::get('tintuc',function(){
		return view('user.pages.tintuc');
	});

	Route::get('chitietsanpham/idsp={id}','sanphamcontroller@getsanphamchitietsanpham');

	Route::get('dangky',function(){
		return view('user.pages.dangki');
	});
	Route::post('dangnhap',['as'=>'dangnhap','uses'=>'usercontroller@getformdangnhap']);

	Route::any('getdangnhap',['as'=>'getdangnhap','uses'=>'usercontroller@getdangnhapuser']);

	Route::get('hoso/{id}','usercontroller@gethosouser');

	Route::get('thietlap/{id}', 'usercontroller@getthietlapuser');

	Route::get('logout','usercontroller@logoutuser');

	Route::post('postdangky','usercontroller@dangkyuser')->name('user.dangky');

	Route::get('danhmuc/iddm={id}','sanphamcontroller@getdanhmucuser');

	Route::get('loaidanhmuc/idldm={id}','sanphamcontroller@getloaidanhmucuser');

	Route::get('phanloai/idpl={id}','sanphamcontroller@getphanloaiuser');

	Route::get('binhluan',['as'=>'binhluan','uses'=>'ratecontroller@guicmt']);

	Route::get('phuongtien/lpt={id}','tintuccontroller@gettintucuser');

	Route::get('phuongtien/lpt={id}/idpt={idpt}','tintuccontroller@getchitiettintucuser');

	Route::get('phuongtien/tangluotxem/{id}','tintuccontroller@tangview');

	Route::get('giohang/themsanpham/{id}','cartcontroller@addcart');

	Route::get('giohang/danhsach','cartcontroller@getcart');

	Route::get('giohang/xoa/{id}','cartcontroller@remove');

	Route::get('giohang/sua/{id}/{sl}','cartcontroller@update');

	Route::get('giohang/dathang','cartcontroller@dathang');

	Route::get('giohang/suasl/{id}/{sl}','cartcontroller@layslsp');

	Route::post('giohang/postdathang',['as'=>'postdathang','uses'=>'cartcontroller@postdathang']);

	Route::get('giohang/postdathang/{txtid}/{txtname}/{txtnoigiao}/{txtsdt}/{txtemail}','cartcontroller@postdathang1');

	Route::get('giohang/theodoidonhang','cartcontroller@theodoidonhang');
	Route::get('giohang/chuyenhoanthanh/{id}','cartcontroller@chuyenhoanthanh');

	Route::get('timkiem',['as'=>'timkiem','uses'=>'sanphamcontroller@timkiem']);
	
	Route::get('lienhe','lienhecontroller@lienhe');

	Route::get('guilienhe','lienhecontroller@guilienhe');

	Route::get('baotri',function(){
		return view('user.pages.phattrien');
	});

});
