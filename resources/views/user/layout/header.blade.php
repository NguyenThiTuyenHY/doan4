<style type="text/css" media="screen">
	.changecolor{
		position: absolute;
		top:0 !important;
	}
	.hovershow:hover .dropdown-menu{
		display: block;
	}
	#thanhhome .login{
		color: #fff;
		text-decoration: none;
		font-size: 14px;
	}
	#thanhhome .login:hover{
		color: #eeeeee;
	}
	#formlogin .login:hover{
		color: #eeeeee;
	}
</style>
<div style="background-color: #006699; height: 30px;" >
	@if(Session::has('co_login'))
	<div id="thanhhome" class="row">	
		<div class="col-6"></div>	
		<div class="col-3">
			<form class="form-inline" action="user/timkiem" method="get" accept-charset="utf-8">
				<input type="text" name="txtsearch" style=" width: 200px;height: 22px; font-size: 13px;" placeholder="Tìm sản phẩm">
				<button class="ml-1" style="background-color: #3399cc;border: rgba(0,0,0,.5) solid .5px;" type="submit" ><i class="fa fa-chevron-right" aria-hidden="true" style="color: #fff;"></i></button>
			</form>
		</div>
		<div class="col-3 hovershow">
			<a class="nav-link dropdown-toggle" href="/user/trangchu" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:-7px; color: #fff;">
				<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Session::get("co_login")->tentaikhoan }}</span>
				<img class="img-profile rounded-circle" src="upload/user/{{ Session::get("co_login")->hinhanh }}" style="width: 30px;">
			</a>
			<div class="dropdown-menu shadow animated--grow-in" aria-labelledby="userDropdown" style="z-index: 10000000;margin-left: 55px; margin-top:-10px;">
				<a class="dropdown-item" href="user/giohang/danhsach">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					Giỏ hàng
				</a>
				<a class="dropdown-item" href="user/giohang/theodoidonhang">
					<i class="fa fa-heartbeat" aria-hidden="true"></i>
					Theo dõi đơn hàng
				</a>
				<a class="dropdown-item" href="user/hoso/{{ Session::get('co_login')->id }}">
					<i class="fa fa-address-book" aria-hidden="true"></i>
					Hồ sơ
				</a>
				<a class="dropdown-item" href="user/thietlap/{{ Session::get('co_login')->id }}">
					<i class="fa fa-cog" aria-hidden="true"></i>
					Cài đặt
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
					<i class="fa fa-sign-out" aria-hidden="true"></i>
					Đăng xuất
				</a>
			</div>
		</div>
	</div>
	@else
	<div id="thanhhome" class="row">	
		<div class="col-5"></div>	
		<div class="col-3">
			<form class="form-inline" action="user/timkiem" method="get" accept-charset="utf-8">
				<input type="text" name="txtsearch" style=" width: 200px;height: 22px; font-size: 13px;" placeholder="Tìm sản phẩm">
				<button class="ml-1" style="background-color: #3399cc;border: rgba(0,0,0,.5) solid .5px;" type="submit" ><i class="fa fa-chevron-right" aria-hidden="true" style="color: #fff;"></i></button>
			</form>
		</div>
		<div class="col-4">
			<a href="user/giohang/danhsach" class="login" style="float: left;">Giỏ hàng</a>
			<span style="float: left;">&nbsp; / &nbsp;</span>
			<form method="post" action="{{ route('dangnhap') }}" id="formlogin" style="float: left; font-size: 14px;">
				@csrf
				<input type="hidden" name="txturl" value="<?php echo $_SERVER['PHP_SELF'] ?>">
				<button type="submit" class="login" style="border: none; background-color: #006699; color: #fff;">Đăng nhập</button>
			</form>
			&nbsp;/ &nbsp;
			<a href="user/dangky" class="login">Đăng ký</a>

		</div>
	</div>
	@endif
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Thật sự rời khỏi đây?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Ấn đăng xuất để đăng xuất khỏi trang này.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Trở về</button>
					<a class="btn btn-primary" href="user/logout">Đăng xuất</a>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar fixed-top navbar-expand-sm navbar-light bg-light" id="startchange" style="width: 60% !important; margin: auto !important; margin-top: 65px !important; height: 30px !important;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="user/trangchu">TRANG CHỦ</a>
				</li>
				<div class="hovershow">
					<li class="nav-item dropdown ml-4">
						<a class="nav-link " href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							SẢN PHẨM
						</a>
						<div class="dropdown-menu" style="width: 700px !important; margin-top: -5px;" aria-labelledby="navbarDropdown">
							<div class="row">
								@foreach($dms as $dm)
								<div class="col-4">
									<ul style="padding: 0px; list-style:none;"><span style="margin-left: 5px; color: blue;"><small><i class="fa fa-heart" style="color: red;" aria-hidden="true"></i></small>&nbsp;<b>{{ $dm->tendm }}</b></span>
										@foreach($dm->loaidanhmuc as $ldm)
										<li style="margin-left: 5px;">+ <a href="user/danhmuc/iddm={{ $ldm->id }}" style="color: black;">{{ $ldm->tenldm }}</a></li>
										@endforeach
									</ul>
								</div>

								@endforeach
							</div>
							
							
						</div>
					</li>
				</div>
				{{-- <div class="hovershow">
					<li class="nav-item dropdown ml-4">
						<a class="nav-link " href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							DỊCH VỤ
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							
						</div>
					</li>
				</div> --}}
				@foreach($theloai as $tl)
				<div class="hovershow">
					<li class="nav-item dropdown ml-4">
						<a class="nav-link text-uppercase" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{ $tl->tentl }}
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-top: -5px;">
							@foreach($tl->loaitheloai as $lth)
								<a class="dropdown-item" href="user/phuongtien/lpt={{ $lth->id }}">{{$lth->tenltl}}</a>
							@endforeach
						</div>
					</li>
				</div>
				@endforeach
				{{-- <div class="hovershow">
					<li class="nav-item dropdown ml-4">
						<a class="nav-link " href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							GIẢI PHÁP 
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
				</div>
				<div class="hovershow">
					<li class="nav-item dropdown ml-4">
						<a class="nav-link " href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							TIN TỨC
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
				</div> --}}
				<li class="nav-item ml-4">
					<a class="nav-link" href="#">KHÁCH HÀNG</a>
				</li>
				<li class="nav-item ml-4">
					<a class="nav-link" href="user/lienhe">LIÊN HỆ</a>
				</li>
			</ul>
		</div>
	</nav>
</div>
@section('script1')
<script>
	$(document).ready(function(){    
		var scroll_start = 0;
		var startchange = $('#startchange');
		var offset = startchange.height() + 95;
		$(document).scroll(function() { 
			scroll_start = $(this).scrollTop();
			if(scroll_start > offset) {
				$("div nav").first().attr('style','box-shadow: 2px 2px 2px 2px rgba(0,0,0,.5);height:'+(offset+scroll_start));
				$("#navbarSupportedContent ul li").first().attr('style','margin-left:250px');
			} else {
				$("div nav").first().attr('style','width: 60% !important; margin: auto !important; margin-top: 65px !important; height: 30px !important;');
				$("#navbarSupportedContent ul li").first().attr('style','');
			}
		});
				// $('.hovershow').mouseover(function(event) {
		// 	/* Act on the event */
		// 	// $a = $(this).attr('class', 'hovershow show');
		// 	const $this = $(this);
		// 	$this.find($dropdownToggle).attr("aria-expanded", "true");
		// 	$this.find($dropdownMenu).addClass(showClass);
		// });
		// $('.hovershow').mousemove(function(event) {
		// 	/* Act on the event */
		// 	const $this = $(this);
		// 	$this.find('$dropdownToggle').attr("aria-expanded", "false");
		// 	$this.find($dropdownMenu).removeClass(showClass);
		// });
	});
</script>
@endsection