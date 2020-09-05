@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800"> Thêm sản phẩm</h1>
<p class="mb-4">Thêm mới thông tin sản phẩm về cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Thông tin sản phẩm</h6>
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
				@if(session('thongbao')!="")
					<div class="alert alert-success">{{ session('thongbao') }}</div>
				@endif
				<form action="{{ route('postthemsp') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="txtdm">Danh mục</label>
								<select class="form-control" id="txtdm" name="txtdm">
									@foreach($dms as $dm)
									<option value="{{ $dm->id }}">{{ $dm->tendm }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group" id="txttbl" style="display: none;">   
								<label for="txttb">Thiết bị</label>  				
								<select class="form-control" id="txttb" name="txttb">
								</select>
							</div>
							<div class="form-group">
								<label for="txtten">Tên sản phẩm</label>
								<input type="text" class="form-control" id="txttsp" name="txttsp">
								<span id="tbtsp" style="color: red;"></span>
							</div>
							<div class="form-group">
								<label for="exampleFormControlFile1">Hình ảnh</label>
								<input type="file" class="form-control-file" id="txtha" name="txtha">
								<span id="tbha" style="color: red;"></span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="txtldm">Loại danh mục</label>
								<select class="form-control" id="txtldm" name="txtldm">
									<option>Bạn chưa chọn danh mục</option>
								</select>
							</div>
							<div class="form-group">
								<label for="txtten">Tóm tắt</label>
								<textarea class="form-control"  name="txttt"></textarea>
							</div> 
							<div class="form-group">
								<label for="txtgia">Giá</label>
								<input type="text" class="form-control" id="txtgia" name="txtgia">
								<span id="tbgia" style="color: red;"></span>
							</div>
							<div class="form-group">
								<label for="txtsl">Số lượng</label>
								<input type="text" class="form-control" id="txtsl" name="txtsl">
								<span id="tbsl" style="color: red;"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="txtten">Nội dung</label>
						<textarea id="demo" class="ckeditor" name="txtnd"></textarea>
					</div> 
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
					</div>
				</form>
			</div>
			<div class="col-4">
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
	$('#txtdm').click(function(event) {
		/* Act on the event */
		$a = $('#txtdm').val();
		$.get('admin/ajax/danhmuc/'+$a,function(data){
			$('#txtldm').html(data);
		});
	});
	$('#txtldm').click(function(event) {
		/* Act on the event */
		$a = $('#txtldm').val();
		$.get('admin/ajax/theloai/'+$a,function(data){
			if(data["stt"]>0){
				$('#txttbl').css('display','block');
				$('#txttb').html(data["ds"]);
			}
			else{
				$('#txttbl').css('display','none');
			}
		});
	});
</script>
@endsection