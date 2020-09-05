@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800"> Thêm các phương tiện</h1>
<p class="mb-4">Thêm mới thông tin các phương tiện về cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Thông tin phương tiện</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-8">
				@isset($erorr)
					<div class="alert alert-danger">
						@foreach ($erorr->all() as $er)
							{{ $er }}<br>
						@endforeach
					</div>
				@endisset
				@if(session('thongbao')!="")
					<div class="alert alert-success">{{ session('thongbao') }}</div>
				@endif
				<form action="{{ route('postthem') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="txtth">Thể loại</label>
						<select class="form-control" id="txttt" name="txttt">
							@foreach($ths as $th)
							<option value="{{ $th->id }}">{{ $th->tentl }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="txtl">Loại</label>
						<select class="form-control" id="txtl" name="txtl">
							<option value="">--Chọn thể loại trước--</option>
						</select>
					</div>
					<div class="form-group">
						<label for="txttd">Tiêu đề</label>
						<input type="text" class="form-control" id="txttd" name="txttd">
					</div>
					<div class="form-group">
						<label for="txtha">Hình ảnh</label>
						<input type="file" class="form-control-file" id="txtha" name="txtha">
					</div>
					<div class="form-group">
						<label for="txttt">Tóm tắt</label>
						<textarea class="form-control" id="txttt" name="txttt"></textarea>
					</div>
					<div class="form-group">
						<label for="txtten">Nội dung</label>
						<textarea id="demo" class="ckeditor" name="txtnd"></textarea>
					</div> 
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Thêm tin tức</button>
					</div>
				</form>
			</div>
			<div class="col-4">
				<video controls>
					<source src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
						
				</video>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	CKEDITOR.replace('demo' ,{
		filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
	});
	$("#txttt").click(function(event) {
		/* Act on the event */
		$a = $(this).val();
		$.get('admin/ajax/tintucgetloaithem/'+$a,function(data){
			$('#txtl').html(data);
		});
	});
</script>
@endsection