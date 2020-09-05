@extends('admin.layout.index')
@section('noidung')
<link rel="stylesheet" href="./user/css/style.css">
<h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>
<p class="mb-4">Đơn hàng trong cửa hàng gồm: chưa xác nhận, xác nhận, đang giao, đã giao, hủy</p>

<!-- DataTales Example -->
<?php $url = $_SERVER['PHP_SELF']; ?>
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách 
			@if(strpos($url,'1')>0) Đơn hàng chưa xác nhận @endif 
			@if(strpos($url,'2')>0) Đơn hàng xác nhận @endif
			@if(strpos($url,'3')>0) Đơn hàng đang giao @endif
			@if(strpos($url,'4')>0) Đơn hàng đã giao @endif
			@if(strpos($url,'5')>0) Đơn hàng hủy @endif
		</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive" style="overflow-x: hidden;">
			{{-- <div class="accordion">	
			@foreach ($donhangs as $donhang)			
				<div class="accordion__item">
					<div class="accordion__item__header">
					</div>
					<div class="accordion__item__content">
					</div>
				</div>
			@endforeach
			</div> --}}
			{{-- @foreach($donhangs as $donhang)
			<div class="accordion__item">
				<div class="accordion__item__header">
					<td>{{ $donhang->id }}</td>
					<td id="{{ $donhang->id }}_1">{{ $donhang->hoten }}</td>
					<td id="{{ $donhang->id }}_2">{{ $donhang->noigiao }}</td> 
					<td id="{{ $donhang->id }}_3">{{ $donhang->sodienthoai }}</td> 
					<td id="{{ $donhang->id }}_2">{{ $donhang->ngaydat }}</td> 
					<td id="{{ $donhang->id }}_2">{{ $donhang->thanhtien }}</td> 
				</div>
				<div class="accordion__item__content">
					<table>
						<thead>
							<tr>
								<th>Tên sản phẩm</th>
								<th>Số lượng</th>
								<th>Đơn giá</th>
							</tr>
						</thead>
						<tbody>									
							@foreach($donhang->sanpham as $sp)
							<tr>
								<td>{{ $sp->sanpham->tensp }}</td>
								<td>{{ $sp->soluong }}</td>
								<td>{{ $sp->dongia }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>					
				</div>
			</div>									
			@endforeach --}}
			{{-- @foreach($donhangs as $donhang)
			<div class="accordion__item">
				<div class="accordion__item__header">
					<td>{{ $donhang->id }} ||</td>
					<td id="{{ $donhang->id }}_1">{{ $donhang->hoten }} ||</td>
					<td id="{{ $donhang->id }}_2">{{ $donhang->noigiao }} ||</td> 
					<td id="{{ $donhang->id }}_3">{{ $donhang->sodienthoai }} ||</td> 
					<td id="{{ $donhang->id }}_2">{{ date('d-m-Y',strtotime($donhang->ngaydat)) }} ||</td> 
					<td id="{{ $donhang->id }}_2">{{ number_format($donhang->thanhtien) }}</td> 
				</div>
				<div class="accordion__item__content">
					<table class="table">
						<thead>
							<tr>
								<th>Tên sản phẩm</th>
								<th>Số lượng</th>
								<th>Đơn giá</th>
							</tr>
						</thead>
						<tbody>								
							@foreach($donhang->chitietdonhang as $sp)
							<tr>
								<td>{{ $sp->sanpham->tensp }}</td>
								<td>{{ $sp->soluong }}</td>
								<td>{{ number_format($sp->dongia) }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>					
				</div>
			</div>
			@endforeach --}}
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
												<button type="button" class="btn btn-success btnxacnhan" title="Chuyển sang đã xác nhận" data-id="{{  $donhang->id }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
												<button type="button" class="btn btn-warning btnhuy" title="Hủy đơn hàng" data-id="{{  $donhang->id }}"><i class="fa fa-times" aria-hidden="true"></i></button>												
											@endif
											@if($donhang->tinhtrang == 2)
												<a href="admin/donhang/intrang/{{ $donhang->id }}" class="btn btn-primary" title="Xem đơn hàng" data-id="{{  $donhang->id }}"><i class="fa fa-eye" target="_b'lank" aria-hidden="true"></i></a>
												<button type="button" class="btn btn-success btndanggiao" title="Chuyển sang đang giao" data-id="{{  $donhang->id }}"  data-toggle="modal" data-target="#ExampModal"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
												<button type="button" class="btn btn-warning btnhuy" title="Hủy đơn hàng" data-id="{{  $donhang->id }}"><i class="fa fa-times" aria-hidden="true"></i></button>												
											@endif
											@if($donhang->tinhtrang == 3)
												<button type="button" class="btn btn-warning btntrongtinhtrangdanggiao" title="Đơn hàng đã bị hủy" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>												
											@endif
											@if($donhang->tinhtrang == 4)
												<button type="button" class="btn btn-warning btntrongtinhtranghoanthanh" title="Đơn hàng đã bị hủy" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>												
											@endif
											@if($donhang->tinhtrang == 5)
												<button type="button" class="btn btn-warning btntrongtinhtranghuy" title="Đơn hàng đã bị hủy" data-id="{{  $donhang->id }}"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>											
											@endif
										</td>
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
		</div>
	</div>
</div>
<form id="fromdanggiao" method="get" accept-charset="utf-8">
	<div class="modal fade" id="ExampModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nhập thông tin dịch vụ vận chuyển</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="txtid" id="txtid">
					<div class="form-group">
						<label for="txtnameshipper">Tên nhà vận chuyển</label>
						<input type="text" class="form-control" name="txtnameshipper" id="txtnameshipper" aria-describedby="emailHelp">
					</div>
					<div class="form-group">
						<label for="txtphoneshipper">Số điện thoại</label>
						<input type="text" class="form-control" name="txtphoneshipper" id="txtphoneshipper" aria-describedby="emailHelp">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Chuyển sang trang thái đang giao</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('script')
<script src="./user/js/accordion.js" type="text/javascript" charset="utf-8" async defer></script>	
<script>
	$('.btnhuy').click(function(event) {
		/* Act on the event */		
		Swal.fire({
			title: 'Bạn chắc chắn?',
			text: "Bạn thật sự muốn chuyển đơn này sang trạng thái hủy!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Đúng vậy'
		}).then((result) => {
			if (result.value) {
				$id = $(this).data('id');
				$.get('admin/donhang/danhsach/tinhtrangchuyenhuy/'+$id,function(data){
					if(data.success){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Chuyển đơn sang trạng thái hủy thành công',
							showConfirmButton: false,
							timer: 1500
						})
						$("#"+$id).remove();
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Chuyển đơn sang trạng thái hủy thất bại',
							showConfirmButton: false,
							timer: 1500
						})
					}
				});
			}
		})
	});
	$('.btnxacnhan').click(function(event) {
		/* Act on the event */		
		Swal.fire({
			title: 'Bạn chắc chắn?',
			text: "Bạn thật sự muốn chuyển đơn này sang trạng thái xác nhận chứ!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Đúng vậy'
		}).then((result) => {
			if (result.value) {
				$id = $(this).data('id');
				$.get('admin/donhang/danhsach/tinhtrangchuyenxacnhan/'+$id,function(data){
					if(data.success){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Chuyển đơn sang trạng thái xác nhận thành công',
							showConfirmButton: false,
							timer: 1500
						})
						$("#"+$id).remove();
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Chuyển đơn sang trạng thái xác nhận thất bại',
							showConfirmButton: false,
							timer: 1500
						})
					}
				});
			}
		})
	});
	$('.btndanggiao').click(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$('#txtid').val($id);

	});
	$("#fromdanggiao").on('submit', function(event) {
		event.preventDefault();
		$id = $('#txtid').val();
		/* Act on the event */
		$.ajax({
			url: '/admin/donhang/danhsach/tinhtrangdanggiao',
			type: 'GET',
			dataType: 'json',
			data: $('#fromdanggiao').serialize(),
			success:function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Chuyển đơn sang trạng thái đang giao thành công',
						showConfirmButton: false,
						timer: 1500
					})
					$("#"+$id).remove();
					$("#fromdanggiao").modal('hide');
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Chuyển đơn sang trạng thái đang giao thất bại',
						showConfirmButton: false,
						timer: 1500
					});
				}
			},
			error:function(data){
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Chuyển đơn sang trạng thái đang giao thất bại',
					showConfirmButton: false,
					timer: 1500
				});
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
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
	$('.btntrongtinhtrangdanggiao').click(function(event) {
		/* Act on the event */
		Swal.fire({
			title: 'Đơn này đang giao bạn không thể thực hiện bất kỳ thao tác nào với đơn hàng này!!',
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
	// $(".btndanggiao").click(function(event) {
	// 	/* Act on the event */
	// });
</script>
@endsection