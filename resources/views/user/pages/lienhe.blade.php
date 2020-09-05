@extends('user.layout.index')
@section('page')
<style>
	#map{
		width: 100%;
		height: 100%;
	}
</style>
<img src="upload/system/header_general.jpg">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item"><a class="text-black-50" href="user/trangchu" title="trang chủ"><i class="fa fa-home" aria-hidden="true"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
  </ol>
</nav>
<div class="row mt-4">
	<div class="col-6">
		<h5>Gửi cho chúng tôi bình luận hoặc câu hỏi của bạn</h5>
		<small class="text-black-50">Quý vị có thể gửi thư tới chúng tôi bằng cách hoàn tất biểu mẫu dưới đây. Để chúng tôi có thể trả lời thư của Quý vị, xin vui lòng khai báo đầy đủ.</small>
		<form id="formlienhe" class="mt-4">
			<div class="form-group row">
				<label for="txthoten"  class="col-sm-3 col-form-label">Họ và tên</label>
				<div class="col-sm-9">
					<input type="text" required class="form-control" name="txthoten" id="txthoten" @if(Session::has('co_login')) value="{{ Session::get('co_login')->name }}" @endif >
				</div>
			</div>
			<div class="form-group row">
				<label for="txtemail" class="col-sm-3 col-form-label">Địa chỉ email</label>
				<div class="col-sm-9">
					<input type="text" required class="form-control" name="txtemail" id="txtemail" @if(Session::has('co_login')) value="{{ Session::get('co_login')->email }}" @endif>
				</div>
			</div>
			<div class="form-group row">
				<label for="txttd" class="col-sm-3 col-form-label">Tiêu đề</label>
				<div class="col-sm-9">
					<input type="text" required class="form-control" name="txttd" id="txttd">
				</div>
			</div>
			<div class="form-group row">
				<label for="txtdt" class="col-sm-3 col-form-label">Điện thoại</label>
				<div class="col-sm-9">
					<input type="text" required class="form-control" name="txtdt" id="txtdt" @if(Session::has('co_login')) value="{{ Session::get('co_login')->sdt }}" @endif>
				</div>
			</div>
			<div class="form-group row">
				<label for="txtnd" class="col-sm-3 col-form-label">Nội dung</label>
				<div class="col-sm-9">
					<textarea name="txtnd" required rows="3" cols="45"></textarea>
				</div>
			</div>
			<div align="center"><button type="submit" class="btn btn-primary">Gửi</button></div>
		</form>
	</div>
	<div class="col-6">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.550898157563!2d106.66355561428695!3d10.769053562275719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ee7f45c848b%3A0x38a61a8a06f9f017!2zMTg4LCA3IFRow6BuaCBUaMOhaSwgcGjGsOG7nW5nIDE0LCBRdeG6rW4gMTAsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1589640285075!5m2!1svi!2s" width="450" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</div>
</div>
@endsection
@section('script')
<script>
	$('#formlienhe').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: 'user/guilienhe',
			type: 'GET',
			dataType: 'json',
			data: $('#formlienhe').serialize(),
			success:function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Gửi thành công',
						showConfirmButton: false,
						timer: 1500
					});
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Gửi thất bại',
						showConfirmButton: false,
						timer: 1500
					});
				}
			},
			erorr:function(data){
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Gửi thất bại',
					showConfirmButton: false,
					timer: 1500
				})
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
</script>
@endsection