@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Khách hàng</h1>
<p class="mb-4">Khách hàng trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách khách hàng</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Hình ảnh</th>
						<th>Tên khách hàng</th>						
						<th>Tuổi</th>
						<th>Địa chỉ</th>
						<th>Số điện thoại</th>
						<th>Trạng thái</th>	
						<th>Tên tài khoản</th>					
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Hình ảnh</th>
						<th>Tên khách hàng</th>						
						<th>Tuổi</th>
						<th>Địa chỉ</th>
						<th>Số điện thoại</th>
						<th>Trạng thái</th>
						<th>Tên tài khoản</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($us as $u)
					@if($u->chucvu == 1)
					<tr>
						<td>{{ $u->id }}</td>
						<td><img src="upload/user/{{ $u->hinhanh }}" alt="" style="width:50px;"></td>
						<td>{{ $u->name }}</td>
						<?php
							$a = getdate();
							$b = explode('-', $u->ngaysinh); 
						?>
						<td>{{ $a["year"] - $b[0] }}</td>
						<td>{{ $u->diachi }}</td>
						<td>{{ $u->sdt }}</td>
						<td class="text-center">
							@if($u->trangthai==1)
								<button style="button" id="{{ $u->id }}_7" class="btn badge badge-info" data-tt="1" data-id="{{ $u->id }}">
									<i class="fa fa-unlock fa-2x" aria-hidden="true"></i>
								</button> 
							
							@else
								<button style="button" id="{{ $u->id }}_7" class="btn badge badge-danger" data-tt="2" data-id="{{ $u->id }}">
									<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
								</button> 
							
							@endif
						</td>
						<td>{{ $u->tentaikhoan }}</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$(".btn").click(function(event) {
		/* Act on the event */
		$b = $(this).data('id');
		$a = $("#"+$b+"_7").attr('data-tt');	
		$.get("admin/khachhang/trangthai/"+$b+"/"+$a,function(data){
			if(data){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Cập nhật trạng thái khách hàng thành công',
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true
				});
				if($a==1){
					$("#"+$b+"_7").attr('data-tt',2);
					$("#"+$b+"_7").attr('class','btn badge badge-danger');
					$("#"+$b+"_7").html('<i class="fa fa-lock fa-2x" aria-hidden="true"></i>');
				}
				if($a==2){
					$("#"+$b+"_7").attr('data-tt',1);
					$("#"+$b+"_7").attr('class','btn badge badge-info');
					$("#"+$b+"_7").html('<i class="fa fa-unlock fa-2x" aria-hidden="true"></i>');
				}
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Cập nhật trạng thái của khách hàng thất bại',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true
				});
			}
		});		
	});
</script>
@endsection