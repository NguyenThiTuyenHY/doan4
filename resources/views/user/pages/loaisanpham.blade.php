@extends('user.layout.index')
@section('page')
<img src="upload/system/header_general.jpg">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
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