@extends('user.layout.index')
@section('page')
<link rel="stylesheet" href="./user/css/style.css">
<img src="./upload/system/shopping-cart-on-blue-background-minimalism-style-creative-design-copy-space-banner-shop-trolley-at-supermarket-sale-discount-shopaholism-conc-PABKK2.jpg" alt="" style="width: 100%; height: 350px;">
<h2 class="text-center" style="margin-top: 30px;">ĐƠN HÀNG CỦA BẠN</h2>
@if(count($donhangs)>0)
<div class="accordion">	
	@foreach ($donhangs as $donhang)			
	<div class="accordion__item" id="{{ $donhang->id }}">
		<div class="accordion__item__header">
			Mã hóa đơn: {{ $donhang->id }}
		</div>

		<div class="accordion__item__content">
			<p>
				<h5 style="text-align: center">ĐƠN HÀNG {{ $donhang->id }}</h5>
				<table class="table">
					<thead>
						<tr>
							<th>Khách hàng</th>
							<th>Nơi giao</th>
							<th>Số điện thoại</th>
							<th>Tình trạng</th>
							@if($donhang->tinhtrang == 3)
							<th>Nhà vận chuyển</th>
							<th>SDT NVC</th>										
							@endif
							<th>Ngày đặt</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $donhang->hoten }}</td>
							<td>{{ $donhang->noigiao }}</td>
							<td>{{ $donhang->sodienthoai }}</td>
							<td>
								@if($donhang->tinhtrang == 1)
								<button type="button" class="btn btn-secondary btntrongtinhtrangchuaxacnhan" title="Đơn hàng chưa xác nhận" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>												
								@endif
								@if($donhang->tinhtrang == 2)
								<button type="button" class="btn btn-secondary btntrongtinhtrangxacnhan" title="Đơn hàng đã xác nhận" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>												
								@endif
								@if($donhang->tinhtrang == 3)
								<button type="button" class="btn btn-primary btnchuyensanghoanthanh" id="{{ $donhang->id }}_button" title="Đơn hàng đang giao" data-id="{{  $donhang->id }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>												
								@endif
								@if($donhang->tinhtrang == 4)
								<button type="button" class="btn btn-success btntrongtinhtranghoanthanh" title="Đơn hàng hoàn thành" data-id="{{  $donhang->id }}"><i class="fa fa-check" aria-hidden="true"></i></button>												
								@endif
								@if($donhang->tinhtrang == 5)
								<button type="button" class="btn btn-danger btntrongtinhtranghuy" title="Đơn hàng đã bị hủy" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>											
								@endif
							</td>
							@if($donhang->tinhtrang == 3)
							<td>{{ $donhang->tenshipper }}</td>
							<td>{{ $donhang->sodienthoaishipper }}</td>									
							@endif
							<td>{{ date('d-m-Y',strtotime($donhang->ngaydat)) }}</td>
							<td>{{ number_format($donhang->thanhtien) }}</td>
						</tr>
					</tbody>
				</table>
			</p>
			<p class="mt-5">
				<h5 style="text-align: center"> CHI TIẾT HÓA ĐƠN</h5>							
				<table class="table">
					<thead>
						<tr>
							<th>STT</th>
							<th>Sản phẩm</th>
							<th>Đơn giá</th>
							<th>Số lượng</th>
						</tr>
					</thead>
					<tbody>
						<?php $t =1; ?>
						@foreach($donhang->chitietdonhang as $ct)
						<tr>
							<td>{{ $t++ }}</td>
							<td>{{ $ct->sanpham->tensp }}</td>
							<td>{{ number_format($ct->dongia) }}</td>
							<td>{{ $ct->soluong }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</p>  
		</div>
	</div>
	@endforeach
</div>
{{ $donhangs->links() }}
@else
<div class="alert alert-primary text-center">Hiện bạn không có đơn hàng nào</div>
@endif
@endsection
@section('script')
<script src="./user/js/accordion.js" type="text/javascript" charset="utf-8" async defer></script>	
<script>
	$('.btntrongtinhtrangchuaxacnhan').click(function(event) {
		/* Act on the event */
		Swal.fire({
			title: 'Đơn này chưa xác nhận bạn không thể thực hiện bất kỳ thao tác nào với đơn hàng này!!',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		});
	});
	$('.btnchuyensanghoanthanh').click(function(event) {
		/* Act on the event */		
		Swal.fire({
			title: 'Bạn chắc chắn?',
			text: "Bạn nhận được hàng mới bấm, không chúng tôi không chịu trách nhiệm!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Chắc chắn'
		}).then((result) => {
			if (result.value) {
				$id = $(this).data('id');
				$.get('user/giohang/chuyenhoanthanh/'+$id,function(data){
					if(data.success){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Thành công, mong sẽ mua hàng ở website thật nhiều',
							showConfirmButton: false,
							timer: 1500
						});
						$('#'+$id+"_button").attr('class','btn btn-success btntrongtinhtranghoanthanh');
						$('#'+$id+"_button").html('<i class="fa fa-check" aria-hidden="true"></i>');
						$('#'+$id+"_button").attr('title','Đơn hàng hoàn thành');
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Thất bại rồi! Thử lại bạn nhé!',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
			}
		});
	});
	$('.btntrongtinhtrangchuaxacnhan').click(function(event) {
		/* Act on the event */
		Swal.fire({
			title: 'Đơn này chưa xác nhận bạn không thể thực hiện bất kỳ thao tác nào với đơn hàng này!!',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		});
	});
	$('.btntrongtinhtranghoanthanh').click(function(event) {
		/* Act on the event */
		
		Swal.fire({
			title: 'Đơn này đã hoàn thành bạn không thể thực hiện bất kỳ thao tác nào với đơn hàng này!!',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		});
	});
	$('.btntrongtinhtranghuy').click(function(event) {
		/* Act on the event */
		Swal.fire({
			title: 'Đơn này đã bị hủy bạn không thể thực hiện bất kỳ thao tác nào với đơn hàng này!!',
			showClass: {
				popup: 'animate__animated animate__fadeInDown'
			},
			hideClass: {
				popup: 'animate__animated animate__fadeOutUp'
			}
		});
	});
</script>
@endsection