@extends('user.layout.index')
@section('page')
<style>
	.table>tbody>tr>td, .table>tfoot>tr>td{
		vertical-align: middle;
	}
	@media screen and (max-width: 600px) {
		table#cart tbody td .form-control{
			width:20%;
			display: inline !important;
		}
		.actions .btn{
			width:36%;
			margin:1.5em 0;
		}

		.actions .btn-info{
			float:left;
		}
		.actions .btn-danger{
			float:right;
		}

		table#cart thead { display: none; }
		table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
		table#cart tbody tr td:first-child { background: #333; color: #fff; }
		table#cart tbody td:before {
			content: attr(data-th); font-weight: bold;
			display: inline-block; width: 8rem;
		}



		table#cart tfoot td{display:block; }
		table#cart tfoot td .btn{display:block;}

	}
</style>
<img src="./upload/system/shopping-cart-on-blue-background-minimalism-style-creative-design-copy-space-banner-shop-trolley-at-supermarket-sale-discount-shopaholism-conc-PABKK2.jpg" alt="" style="width: 100%; height: 350px;">
<h2 class="text-center" style="margin-top: 30px;">GIỎ HÀNG CỦA BẠN</h2>
@if($totalquantity >0)
<table id="cart" class="table table-hover table-condensed" style="margin-top: 30px;">
	<thead>
		<tr>
			<th style="width:50%">Sản phẩm</th>
			<th style="width:10%">Đơn giá</th>
			<th style="width:10%">Số lượng</th>
			<th style="width:20%" class="text-center">Tổng</th>
			<th style="width:10%"></th>
		</tr>
	</thead>
	<tbody id="bodycart">
		@foreach($cart as $car)
		<tr id="cart_{{ $car->id }}">
			<td data-th="Product">
				<div class="row">
					<div class="col-sm-3 hidden-xs"><img src="./upload/sanpham/{{ $car->attributes->img }}" alt="..." class="img-responsive"/ style="width: 100px; height: 100px;"></div>
					<div class="col-sm-9">
						<h4 class="nomargin" style="font-size: 15px;">{{ $car->name }}</h4>
					</div>
				</div>
			</td>
			<td data-th="Price">{{ number_format($car->price) }}</td>
			<td data-th="Quantity">
				<input type="number" class="form-control text-center changequantity" data-id="{{ $car->id }}" data-sl="{{ $car->quantity }}" id="cart_{{ $car->id }}_1" value="{{ $car->quantity }}" min="1" max="{{ $car->attributes->quantity }}">
			</td>
			<td data-th="Subtotal" class="text-center" id="cart_{{ $car->id }}_2">{{ number_format($car->price * $car->quantity) }}</td>
			<td class="actions" data-th="">
				<button class="btn btn-info btn-sm btnsua" data-id="{{ $car->id }}"><i class="fa fa-refresh"></i></button>
				<button class="btn btn-danger btn-sm btnremove" data-id="{{ $car->id }}"><i class="fa fa-trash-o"></i></button>								
			</td>
		</tr>
		@endforeach
		
	</tbody>
	<tfoot>
		<tr>
			<td><a href="user/trangchu" class="btn btn-warning"><i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
			</td>
			<td colspan="2" class="hidden-xs text-center"><strong>Tổng: <span id="subtotal">{{ number_format($subtotal) }}</span></strong></td>
			<td colspan="2"><a href="user/giohang/dathang" style="width: 150px; margin-left: 140px;" class="btn btn-success btn-block">Đặt hàng <i class="fa fa-angle-right" aria-hidden="true"></i><i class="fa fa-angle-right" aria-hidden="true"></i></a></td>
		</tr>
	</tfoot>
</table>
@else
<div class="alert alert-primary text-center" style="margin-top: 30px;">Giỏ hàng của bạn hiện tại không có sản phẩm</div>
@endif
@endsection
@section('script')
<script>
$(document).ready(function() {
	$('.btnremove').click(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$.get('user/giohang/xoa/'+$id,function(data){
			if(data.success){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Xóa thành công',
					showConfirmButton: false,
					timer: 1500
				});
				$('#cart_'+$id).remove();
				$("#subtotal").text( new Intl.NumberFormat().format(data.subtotalsua));
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Xóa thất bại',
					showConfirmButton: false,
					timer: 1500
				})
			}
		});
	});
	$(".changequantity").change(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$sl = $(this).data('sl'); 
		$slchange = $("#cart_"+$id+"_1").val();
		$.get("user/giohang/suasl/"+$id+"/"+$slchange,function(data){
			if(data.success==false){
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: data.thongbao,
					showConfirmButton: false,
					timer: 2000
				});
				$("#cart_"+$id+"_1").val($sl);
			}
		});
	});
	$('.btnsua').click(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$sl = $("#cart_"+$id+"_1").val();
		$.get('user/giohang/sua/'+$id+'/'+$sl,function(data){
			if(data.success){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Sửa thành công',
					showConfirmButton: false,
					timer: 1500
				});
				$("#subtotal").text( new Intl.NumberFormat().format(data.subtotalxoa));
				$("#cart_"+$id+"_1").val($sl);
				$("#cart_"+$id+"_2").text(new Intl.NumberFormat().format(data.totalproduct));
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Sửa thất bại',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	});
});
</script>
@endsection
