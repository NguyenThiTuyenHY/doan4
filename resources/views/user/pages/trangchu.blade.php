@extends('user.layout.index')
@section('page')
@include('user.blocks.banner')
<div class="mt-3" style=" height: 130px;">
	<a href="user/phuongtien/lpt=4" style="width: 24%; float: left; height: 130px; background-color: #000;">
		<img src="upload/system/giaiphap.png" alt="" style="width: 100%; height: 130px;">
	</a>
	<a href="user/phuongtien/lpt=1" style="width: 24%; height: 130px; float: left; background-color: #000; margin-left: 1.33%">
		<img src="upload/system/dichvu.png" alt="" style="width: 100%; height: 130px;">
	</a>
	<a href="" style="width: 24%; height: 130px; float: left; background-color: #000; margin-left: 1.33%">
		<img src="upload/system/sanpham.png" alt="" style="width: 100%; height: 130px;">
	</a>

	<a href="user/lienhe" style="width: 24%; height: 130px; float: left; background-color: #000; margin-left: 1.33% ">
		<img src="upload/system/dichvukhachhang.png" alt="" style="width: 100%; height: 130px;">
	</a>
</div>
<div style="height: 10px;"></div>
<div style=" margin-top: 20px; clear: left;">
	<h5 class="mt-4" style="border-bottom: 2px solid #0066ff; color: rgba(0,0,0,.6); font-weight: bold;">Sản phẩm mới</h5>
	<div class="mt-1">
		@include('user.blocks.sanphammoi')
	</div>
</div>
{{-- <div style="height: 200px;"> </div> --}}
<div >
	<h5 class="mt-4" style="border-bottom: 2px solid #0066ff; color: rgba(0,0,0,.6); font-weight: bold;">Sản phẩm bán chạy</h5>
	<div class="mt-1">
		{{-- <a href="" style="width: 19%; height: 200px; float: left; background-color: #000;">

		</a>
		<a href="" style="width: 19%; height: 200px; float: left; background-color: #000; margin-left: 1.25% ">

		</a>
		<a href="" style="width: 19%; height: 200px; float: left; background-color: #000; margin-left: 1.25% ">

		</a>
		<a href="" style="width: 19%; height: 200px; float: left; background-color: #000; margin-left: 1.25% ">

		</a>
		<a href="" style="width: 19%; height: 200px; float: left; background-color: #000; margin-left: 1.25% ">

		</a> --}}
		@include('user.blocks.sanphamnoibat')
	</div>
</div>
{{-- <div style="height: 240px;"> </div> --}}
<div class="mt-3" style=" height: 170px;">
	<div style="width: 24%; float: left; height: 130px; position: relative;">
		<div style="width: 24%; height: 150px;">
			<img src="./upload/system/dichvuchothueit.png" alt="">
		</div>
		<div style="width: 76%;height: 140px; position: absolute; top:0;left: 40px;z-index: 1;"> 
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Dịch vụ</div>
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Cho thuê IT</div>
			<span style="font-size: 13px; color: rgba(0,0,0,.5); ">Dịch vụ hỗ trợ nhân lực CNTT - Cho thuê IT, đáp ứng như cầu quản lý hệ thống, hỗ trợ người dùng cho các công ty không có nhân viên IT cơ hữu.</span><br>
			<a style="font-size: 15px;" href="user/baotri">Xem thêm <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<div style="width: 24%; float: left; height: 130px; position: relative;">
		<div style="width: 24%; height: 150px;">
			<img src="./upload/system/phanphoithietbi.png" alt="">
		</div>
		<div style="width: 76%;height: 140px; position: absolute; top:0;left: 40px;z-index: 1;"> 
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Phân phối</div>
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Thiết bị CNTT</div>
			<span style="font-size: 13px; color: rgba(0,0,0,.5); ">Chuyên phân phối thiết bị mạng, máy chủ, thiết bị lưu trữ, thiết bị bảo mật các hãng: Cisco, HP, IBM, Lenovo, Dell, Mikrotik,Extreme, Infortrend, Fortigate, ...</span><br/>
			<a style="font-size: 15px;" href="user/baotri">Xem thêm <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>

	<div style="width: 24%; float: left; height: 130px; position: relative;">
		<div style="width: 24%; height: 150px;">
			<img src="./upload/system/bantintruyenthong.png" alt="">
		</div>
		<div style="width: 76%;height: 140px; position: absolute; top:0;left: 40px;z-index: 1;"> 
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Latest</div>
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Bản tin & Truyền thông</div>
			<span style="font-size: 13px; color: rgba(0,0,0,.5); ">Các thông tin liên quan đến công nghệ, thông tin nội bộ công ty, thông tin tuyển dụng, ...</span><br>
			<a style="font-size: 15px;" href="user/baotri">Xem thêm <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>
	<div style="width: 24%; float: left; height: 130px; position: relative;">
		<div style="width: 24%; height: 150px;">
			<img src="./upload/system/diendan.png" alt="">
		</div>
		<div style="width: 76%;height: 140px; position: absolute; top:0;left: 40px;z-index: 1;"> 
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Diễn đàn hỗ trợ Kỹ thuật</div>
			<div style="font-size: 15px; color: #003366; font-weight: bold;">Khách hàng</div>
			<span style="font-size: 13px; color: rgba(0,0,0,.5); ">Dịch vụ hỗ trợ nhân lực CNTT - Cho thuê IT, đáp ứng như cầu quản lý hệ thống, hỗ trợ người dùng cho các công ty không có nhân viên IT cơ hữu.</span><br>
			<a style="font-size: 15px;" href="user/baotri">Xem thêm <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</div>
	</div>
</div>	
@endsection