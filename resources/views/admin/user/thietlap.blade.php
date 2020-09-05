@extends('admin.layout.index')
@section('noidung')
<meta name="_token" content="{{ csrf_token() }}">
<h1 class="h3 mb-2 text-gray-800">Thiết lập thông tin cá nhân</h1>
<p class="mb-4">Sửa chữa thông tin cá nhân</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Thông tin cá nhân</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-lg-9">
				<form id="formuser" enctype="multipart/form-data" method="POST">					
					@csrf
					@method('POST')
					<input type="text" style="display: none;" value="{{ $ma }}" placeholder="" name="txtid">
					<div class="form-group">
						<label for="txtten">Họ và tên</label>
						<input type="text" class="form-control" id="txtten" name="txtten" value="{{ $u->name }}">
					</div>
					<div class="form-group">
						<label for="txtns">Ngày sinh</label>
						<input type="date" class="form-control" id="txtns" name="txtns" value="{{ $u->ngaysinh }}">
					</div>
					<div class="form-group">
						<label for="txttentk">Tên tài khoản</label>
						<input type="text" class="form-control" id="txttentk" name="txttentk" value="{{ $u->tentaikhoan }}">
					</div>
					<div class="form-group">
						<label for="txtdiachi">Địa chỉ</label>
						<input type="text" class="form-control" id="txtdiachi" name="txtdiachi" value="{{ $u->diachi }}">
					</div>
					<div class="form-group">
						<label for="txtsdt">Số điện thoại</label>
						<input type="text" class="form-control" id="txtsdt" name="txtsdt" value="{{ $u->sdt }}">
					</div>
					<div class="form-group">
						<label for="txthinh">Hình ảnh</label>
						<input type="file" class="form-control-file" id="txthinh" name="txthinh">
						<img src="./upload/user/{{ $u->hinhanh }}" style="width: 200px;" alt="">
					</div>
					<div class="text-center">
						<button class="btn btn-primary" type="submit">Sửa thông tin</button>
					</div>
				</form>
			</div>
			<div class="col-lg-3">
				
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	$("#formuser").on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajaxSetup({
			headers: {
				'X-XSRF-Token': $('meta[name="_token"]').attr('content')
			}
		});
		var frm ={
			_method: 'get',
			txtten : $('#txtten').val(),
			txtns : $('#txtns').val(),
			txttentk : $('#txttentk').val(),
			txtdiachi :$('#txtdiachi').val(),
			txtsdt : $("#txtsdt").val(),
			txthinh : $("#txthinh").val()
		}
		$.ajax({
			url: '{{ route("khachhang.suathietlap") }}',
			type: 'POST',
			dataType: 'json',
			data: new FormData($("#formuser")[0]),
			contentType: false,
			cache:false,
			processData: false,
			success:function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: data.thongbao,
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function(){
						window.location = window.location.pathname;
					},2000);
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: data.thongbao,
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function(){
						window.location = window.location.pathname;
					},2000);
				}
			},
			error:function(error){
				alert(error);
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function(xhr, status, error) {
      		//Ajax request failed.
      		var errorMessage = xhr.status + ': ' + xhr.statusText;
      		alert('Error - ' + errorMessage);
  		})
		.always(function() {
			console.log("complete");
		});
		
	});
</script>
@endsection