@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800"> Sửa sản phẩm</h1>
<p class="mb-4">Sửa thông tin sản phẩm về cửa hàng</p>

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
				<form action="/admin/sanpham/postsuasp" method="post" enctype="multipart/form-data">					
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<input type="hidden" name="txtid" value="{{ $sps->id }}">
							<div class="form-group">
								<label for="txtdm">Danh mục</label>
								<select class="form-control" id="txtdm" name="txtdm">
									@foreach($dms as $dm)
									@if($dm->id == $sps->loaidanhmuc->id)
										<option value="{{ $dm->id }}" selected="true">{{ $dm->tendm }}</option>
									@else
										<option value="{{ $dm->id }}">{{ $dm->tendm }}</option>
									@endif
									@endforeach
								</select>
							</div>
							@if($sps->idpl !=null)
							<div class="form-group" id="txttbl">   
								<label for="txttb">Thiết bị</label>  				
								<select class="form-control" id="txttb" name="txttb">
									@foreach($pls as $pl)
									@if($pl->id == $sps->idpl)
										<option value="{{ $pl->id }}" selected="true">{{ $pl->tenpl }}</option>
									@else
										<option value="{{ $pl->id }}">{{ $pl->tenpl}}</option>
									@endif
									@endforeach
								</select>
							</div>
							@endif
							<div class="form-group">
								<label for="txtten">Tên sản phẩm</label>
								<input type="text" class="form-control" id="txttsp" name="txttsp" value="{{ $sps->tensp }}">
								<span id="tbtsp" style="color: red;"></span>
							</div>
							<div class="form-group">
								<label for="exampleFormControlFile1">Hình ảnh</label>
								<input type="file" class="form-control-file" id="txtha" name="txtha">
								<span id="tbha" style="color: red;"></span>
								<img class="mt-3"  src="upload/sanpham/{{ $sps->hinhanh }}" style="width: 100px" alt="">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="txtldm">Loại danh mục</label>
								<select class="form-control" id="txtldm" name="txtldm">
									@foreach($ldms as $ldm)
									@if($dm->id == $sps->idl)
										<option value="{{ $ldm->id }}" selected="true">{{ $ldm->tenldm }}</option>
									@else
										<option value="{{ $ldm->id }}">{{ $ldm->tenldm }}</option>
									@endif
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="txtten">Tóm tắt</label>
								<textarea class="form-control"  name="txttt">{{ $sps->tomtat }}</textarea>
							</div> 
							<div class="form-group">
								<label for="txtgia">Giá</label>
								<input type="text" class="form-control" id="txtgia" name="txtgia" value="{{ $sps->gia }}">
								<span id="tbgia" style="color: red;"></span>
							</div>
							<div class="form-group">
								<label for="txtsl">Số lượng</label>
								<input type="text" class="form-control" id="txtsl" name="txtsl" value="{{ $sps->soluong }}">
								<span id="tbsl" style="color: red;"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="txtten">Nội dung</label>
						<textarea id="demo" class="ckeditor" name="txtnd">{{ $sps->chitiet }}</textarea>
					</div> 
					<div style="text-align: center;">
						<button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
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