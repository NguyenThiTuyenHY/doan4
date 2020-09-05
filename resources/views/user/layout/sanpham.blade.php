@extends('user.layout.index')
@section('page')
<img src="upload/system/header_general.jpg">
<?php $url = $_SERVER['PHP_SELF'] 
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  	@if(strpos($url,'idsp'))
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu" title="trang chủ"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item"><a class="text-black-50" href="user/danhmuc/iddm={{ $sp->loaidanhmuc->danhmuc->id }}">{{ $sp->loaidanhmuc->danhmuc->tendm }}</a></li>
    <li class="breadcrumb-item"><a class="text-black-50" href="user/loaidanhmuc/idldm={{ $sp->loaidanhmuc->id }}">{{ $sp->loaidanhmuc->tenldm }}</a></li>
    @if(strlen($sp->phanloai->tenpl))
     <li class="breadcrumb-item"><a class="text-black-50" href="user/phanloai/idpl={{ $sp->phanloai->id }}">{{ $sp->phanloai->tenpl }}</a></li>
    @endif
    <li class="breadcrumb-item active" aria-current="page">{{ $sp->tensp }}</li>
    @endif



    @if(strpos($url,'iddm'))
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu" title="trang chủ"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $dm->tendm }}</a></li>
    @endif
    

    @if(strpos($url,'idldm'))
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu" title="trang chủ"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item"><a class="text-black-50" href="user/danhmuc/iddm={{ $ldm->danhmuc->id }}" title="trang chủ">{{ $ldm->danhmuc->tendm }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $ldm->tenldm }}</a></li>
    @endif


    @if(strpos($url,'idpl'))
    <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu" title="trang chủ"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item"><a class="text-black-50" href="user/danhmuc/iddm={{ $pl->loaidanhmuc->danhmuc->id }}" title="trang chủ">{{ $pl->loaidanhmuc->danhmuc->tendm }}</a></li>
    <li class="breadcrumb-item"><a class="text-black-50" href="user/loaidanhmuc/idldm={{ $pl->loaidanhmuc->id }}" title="trang chủ">{{ $pl->loaidanhmuc->tenldm }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $pl->tenpl }}</a></li>
    @endif
    @if(strpos($url,'timkiem'))
    <li class="breadcrumb-item active" aria-current="page"><b>Tìm kiếm từ khóa:</b>  <span style="color:red;">{{ $tukhoa }}</span> <small> ({{ count($sps) }} kết quả)</small></a></li>
    @endif
  </ol>
</nav>
<div class="row">
	<div class="col-3">
		@include('user.blocks.chitietbenphai')
		<img src="upload/system/banner_phai1.png" style="width: 215px;" alt="">
		<img src="upload/system/banner_phai2.png" style="width: 215px;" alt="">
		<img src="upload/system/banner_phai3.jpg" style="width: 215px;" alt="">
	</div>
	<div class="col-9">
		@yield('content')
	</div>
</div>
@endsection