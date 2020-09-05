@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800"> Sửa các phương tiện</h1>
<p class="mb-4">Sửa các thông tin phương tiện về cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Thông tin phương tiện</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-8">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				{{ session('kq') }}
				@if(session('thongbao'))
				<div class="alert alert-success">{{ session('thongbao') }}</div>
				@endif
				<form action="{{ route('postsuatt') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="txtth">Thể loại</label>
						<select class="form-control" id="txttt" name="txttt">
							@foreach($ths as $th)
							@if($th->id == $idtt)
							<option value="{{ $th->id }}" selected="true">{{ $th->tentl }}</option>
							@else()
							<option value="{{ $th->id }}">{{ $th->tentl }}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="txtl">Loại</label>
						<select class="form-control" id="txtl" name="txtl">
							@foreach($ls as $l)	
							@if($l->id == $tt["idltl"])
									<option value="{{ $l->id }}" selected="true">{{ $l->tenltl }}</option>
								@else
									<option value="{{ $l->idl }}">{{ $l->tenltl }}</option>
								@endif							
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="txttd">Mã</label>
						<input type="text" class="form-control" readonly="true" id="txtid" name="txtid" value="{{ $tt["id"] }}">
					</div>
					<div class="form-group">
						<label for="txttd">Tiêu đề</label>
						<input type="text" class="form-control" id="txttd" name="txttd" value="{{ $tt["tieude"] }}">
					</div>
					<div class="form-group">
						<label for="txtha">Hình ảnh</label>
						<input type="file" class="form-control-file" id="txtha" name="txtha">
						<img class="mt-2" style="width: 100px;" src="upload/tintuc/{{ $tt["hinhanh"] }}" alt="">
					</div>
					<div class="form-group">
						<label for="txttt">Tóm tắt</label>
						<textarea class="form-control" id="txttt" name="txttt">{{ $tt["tomtat"] }}</textarea>
					</div>
					<div class="form-group">
						<label for="txtten">Nội dung</label>
						<textarea id="demo" class="ckeditor" name="txtnd">{{ $tt["chitiet"] }}</textarea>
					</div> 
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Sửa tin tức</button>
					</div>
				</form>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	CKEDITOR.replace( 'demo' ,{
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