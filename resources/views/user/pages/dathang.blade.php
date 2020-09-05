@extends('user.layout.index')
@section('page')
<style type="text/css" media="screen">
	.main-heading {
		font-size: 19px;
		margin-bottom: 20px;
	}
	.table-cart{
		padding: 10px 10px 10px 10px;
		/* text-align: center; */
		border: 2px dotted #e5e5e5;
		border-radius: 10px;
		margin-top: 55px;
	}
	.table-cart table {
		width: 100%;
	}
	.table-cart thead {
		border-bottom: 1px solid #e5e5e5;
		margin-bottom: 5px;
	}
	.table-cart thead tr th {
		padding: 8px 0 18px;
		color: #484848;
		font-size: 15px;
		font-weight: 400;
	}
	.table-cart tr td {
		padding: 40px 0 27px;
		vertical-align: middle;
	}
	.table-cart tr td:nth-child(1) {
		width: 52%;
	}
	.table-cart tr td:nth-child(2) {
		width: 26%;
	}
	.table-cart tr td:nth-child(3) {
		width: 13.333%;
	}
	.table-cart tr td:nth-child(4) {
		width: 8.667%;
		text-align: right;
	}
	.table-cart tr td .img-product {
		width: 72px;
		float: left;
		margin-left: 8px;
		margin-right: 31px;
		line-height: 63px;
	}
	.table-cart tr td .img-product img {
		width: 100%;
	}
	.table-cart tr td .name-product {
		font-size: 15px;
		color: #484848;
		padding-top: 8px;
		line-height: 24px;
		width: 50%;
	}
	.table-cart tr td .price {
		text-align: right;
		line-height: 64px;
		margin-right: 40px;
		color: #989898;
		font-size: 16px;
		font-family: 'Nunito';
	}
	.table-cart tr td .quanlity {
		position: relative;
	}
	.product-count .qtyminus,
	.product-count .qtyplus {
		width: 34px;
		height: 34px;
		background: transparent;
		text-align: center;
		font-size: 19px;
		line-height: 34px;
		color: #000;
		cursor: pointer;
		font-weight: 600;
	}
	.product-count .qtyminus {
		line-height: 32px;
	}
	.product-count .qtyminus {
		border-radius: 3px 0 0 3px; 
	}
	.product-count .qtyplus {
		border-radius: 0 3px 3px 0; 
	}
	.product-count .qty {
		width: 60px;
		text-align: center;
		border: none;
	}
	.count-inlineflex {
		display: inline-flex;
		border: solid 2px #ccc;
		border-radius: 20px;  
	}
	.total {
		font-size: 24px;
		font-weight: 600;
		color: #8660e9;
	}
	.display-flex {
		display: flex;
	}
	.align-center {
		align-items: center;
	}

	.coupon-box {
		
	}
	.coupon-box ul{
		list-style: none;
	}
	/* .coupon-box form input {
		display: inline-block;
		width: 264px;
		margin-right: 13px;
		height: 44px;
		border-radius: 25px;
		border: solid 2px #cccccc;
		padding: 5px 15px;
		font-size: 14px;
	} */
	input:focus {
		outline: none;
		box-shadow: none;
	}
	.round-black-btn {
		border-radius: 25px;
		background: #212529;
		color: #fff;
		padding: 8px 35px;
		display: inline-block;
		border: solid 2px #212529; 
		transition: all 0.5s ease-in-out 0s;
		cursor: pointer;
	}
	.round-black-btn:hover,
	.round-black-btn:focus {
		background: transparent;
		color: #212529;
		text-decoration: none;
	}
	.cart-totals {
		border-radius: 3px;
		background: #e7e7e7;
		padding: 25px;
	}
	.cart-totals h3 {
		font-size: 19px;
		color: #3c3c3c;
		letter-spacing: 1px;
		font-weight: 500;
	}
	.cart-totals table {
		width: 100%;
	}
	.cart-totals table tr th,
	.cart-totals table tr td {
		width: 50%;
		padding: 3px 0;
		vertical-align: middle;
	}
	.cart-totals table tr td:last-child {
		text-align: right;
	}
	.cart-totals table tr td.subtotal {
		font-size: 20px;
		color: #6f6f6f;
	}
	.cart-totals table tr td.free-shipping {
		font-size: 14px;
		color: #6f6f6f;
	}
	.cart-totals table tr.total-row td {
		padding-top: 25px;
	}
	.cart-totals table tr td.price-total {   
		font-size: 24px;
		font-weight: 600;
		color: #8660e9;
	}
	.btn-cart-totals {
		text-align: center;
		margin-top: 60px;
		margin-bottom: 20px;
	}
	.btn-cart-totals .round-black-btn {
		margin: 10px 0; 
	}
</style>
<img src="./upload/system/shopping-cart-on-blue-background-minimalism-style-creative-design-copy-space-banner-shop-trolley-at-supermarket-sale-discount-shopaholism-conc-PABKK2.jpg" alt="" style="width: 100%; height: 350px;">
<h2 class="text-center" style="margin-top: 30px;">ĐẶT HÀNG</h2>
{{-- <form id="formdathang" enctype="Multipart/Form-Data" > --}}
	<div class="row">
		<div class="col-6">
			<h5>Thông tin khách hàng</h5>
			<input type="hidden" id="txtid" name="txtid" @if(Session::has('co_login')) value="{{ Session::get("co_login")->id }}" @else value="0" @endif>
			<div class="form-group">
				<label for="txtname">Họ và tên</label>
				<input type="text" class="form-control" id="txtname" name="txtname" @if(Session::has('co_login')) value="{{ Session::get("co_login")->name }}" @endif>
			</div>
			<div class="form-group">
				<label for="txtname">Email</label>
				<input type="text" class="form-control" id="txtemail" name="txtemail" @if(Session::has('co_login')) value="{{ Session::get("co_login")->email}}" @endif>
			</div>
			<div class="form-group">
				<label for="txtnoigiao">Nơi giao</label>
				<input type="text" class="form-control" id="txtnoigiao" name="txtnoigiao" @if(Session::has('co_login')) value="{{ Session::get("co_login")->diachi }}" @endif>
			</div>
			<div class="form-group">
				<label for="txtsdt">Số điện thoại</label>
				<input type="text" class="form-control" id="txtsdt" name="txtsdt" @if(Session::has('co_login')) value="{{ Session::get("co_login")->sdt }}" @endif>
			</div>
		</div>
		<div class="col-6">
			<div class="row">
				<div class="col-lg-12">
					<div class="table-cart">
						<table>
							<thead>
								<tr>
									<th>Sản phẩm</th>
									<th>Số lượng</th>
									<th>Đơn giá</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cart as $car)
								<tr>
									<td>
										<div class="display-flex align-center">
											<div class="img-product">
												<img src="./upload/sanpham/{{ $car->attributes->img }}" alt="" class="mCS_img_loaded">
											</div>
											<div class="name-product">
												<small>{{ $car->name }}</small>
											</div>
										</div>
									</td>
									<td class="product-count">
										<div class="price" style="text-align: center;vertical-align: middle;">
											{{ $car->quantity }}
										</div>
									</td>
									<td>
										<div class="price" style="vertical-align: middle;">
											{{ number_format($car->price) }}
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<hr>
						<div class="coupon-box">
							<ul>
								<li style="text-align: center;">Thành tiền: {{ number_format($subtotal) }}</li>
							</ul>
						</div>
					</div>
					<!-- /.table-cart -->
				</div>
				<!-- /.col-lg-8 -->
			</div>
		</div>
	</div>
	<div align="center" id="btndathang" class="mt-5"><button class="btn btn-danger" type="submit">Đặt hàng</button></div>
{{-- </form> --}}
@endsection
@section('script')
<script>
	$("#btndathang").click(function(event) {
		$a = $('#txtid').val();
		$b = $('#txtname').val();
		$c = $('#txtnoigiao').val();
		$d = $('#txtsdt').val();
		$f = $('#txtemail').val();
		$.get('user/giohang/postdathang/'+$a+'/'+$b+'/'+$c+'/'+$d+'/'+$f,function(data){
			if(data.success){
				let timerInterval
				Swal.fire({
					title: 'Đặt hàng thành công!!',
					html: 'Hệ thống đang xử lý còn <b></b> giây sẽ chuyển bạn đến trang chủ.Và nhớ kiểm tra gmail của bạn nhá!!',
					timer: 2500,
					timerProgressBar: true,
					onBeforeOpen: () => {
						Swal.showLoading()
						timerInterval = setInterval(() => {
							const content = Swal.getContent()
							if (content) {
								const b = content.querySelector('b')
								if (b) {
									b.textContent = Swal.getTimerLeft()
								}
							}
						}, 100)
					},
					onClose: () => {
						clearInterval(timerInterval)
					}
				}).then((result) => {
					/* Read more about handling dismissals below */
					if (result.dismiss === Swal.DismissReason.timer) {
						window.location = 'user/trangchu';
					}
				});
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Đặt hàng thất bại!! Mời bạn thử lại!!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		});
	});
</script>
@endsection

