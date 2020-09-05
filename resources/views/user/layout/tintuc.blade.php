@extends('user.layout.index')
@section('page')
<style type="text/css" media="screen">
	.page_right ul li a{
		font-weight: bold;
		text-decoration: none;
		font-size: 14px;
		color: rgba(0, 0, 0, .7);
	}
	.page_right ul li a:hover{
		color: #ff9933;
	}	
</style>
<img src="upload/system/header_general.jpg" style="width: 100%;">
<?php $url =$_SERVER['PHP_SELF']; ?>
@if(strpos($url,'lpt=7')||strpos($url,'lpt=8')||strpos($url,'lpt=9'))
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
    @if(strpos($url,'lpt=7')>0)
    <li class="breadcrumb-item active" aria-current="page">Tin tức công nghệ</li>
    @endif
    @if(strpos($url,'lpt=8')>0)
    <li class="breadcrumb-item active" aria-current="page">Chính sách bảo hành</li>
    @endif
    @if(strpos($url,'lpt=9')>0)
    <li class="breadcrumb-item active" aria-current="page">Tin tức công nghệ</li>
    @endif
  </ol>
</nav>
@endif
@if(strpos($url,'lpt=4')>0||strpos($url,'lpt=5')>0||strpos($url,'lpt=6')>0)
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Giải pháp</li>
    @if(strpos($url,'lpt=4')>0)
    <li class="breadcrumb-item active" aria-current="page">Giải pháp mạng LAN - WAN</li>
    @endif
    @if(strpos($url,'lpt=5')>0)
    <li class="breadcrumb-item active" aria-current="page">Giải pháp lưu trữ</li>
    @endif
    @if(strpos($url,'lpt=6')>0)
    <li class="breadcrumb-item active" aria-current="page">Giải pháp nguồn điện</li>
    @endif
  </ol>
</nav>
@endif
@if(strpos($url,'lpt=1')>0||strpos($url,'lpt=2')>0||strpos($url,'lpt=3')>0)
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Dịch vụ</li>
    @if(strpos($url,'lpt=1')>0)
    <li class="breadcrumb-item active" aria-current="page">Dịch vụ Hỗ trợ nhân lực CNTT</li>
    @endif
    @if(strpos($url,'lpt=2')>0)
    <li class="breadcrumb-item active" aria-current="page">Các dịch vụ online</li>
    @endif
    @if(strpos($url,'lpt=3')>0)
    <li class="breadcrumb-item active" aria-current="page">Tư vấn giải pháp hệ thống</li>
    @endif
  </ol>
</nav>
@endif
<div class="page_right row">
	<div class="col-3">
		<div>
			<h4 class="text-black-50">Menu</h4>
			<ul style="border: solid rgba(0,0,0,.3) 1px; list-style: none;"> 
				@if(strpos($url,'lpt=7')||strpos($url,'lpt=8')||strpos($url,'lpt=9'))
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=7" class="">Tin tức công nghệ</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=8">Chính sách bảo hành</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=9">Tuyển dụng</a></li>
				@endif
				@if(strpos($url,'lpt=4')>0||strpos($url,'lpt=5')>0||strpos($url,'lpt=6')>0)
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=4" class="">Giải pháp mạng LAN - WAN</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=5">Giải pháp lưu trữ</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=6">Giải pháp nguồn điện</a></li>
				@endif
				@if(strpos($url,'lpt=1')>0||strpos($url,'lpt=2')>0||strpos($url,'lpt=3')>0)
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=1" class="">Dịch vụ Hỗ trợ nhân lực CNTT</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=2">Các dịch vụ online</a></li>
				<li style="margin-left: -30px;"><a href="user/phuongtien/lpt=3">Tư vấn giải pháp hệ thống</a></li>
				@endif
			</ul>
		</div>
		<img src="upload/system/banner_phai1.png" style="width: 215px;" alt="">
		<img src="upload/system/banner_phai2.png" style="width: 215px;" alt="">
		<img src="upload/system/banner_phai3.jpg" style="width: 215px;" alt="">
	</div>
	<div class="col-8 ml-1">
		@yield('content')
	</div>
</div>
@endsection