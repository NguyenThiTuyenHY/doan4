@extends('admin.layout.index')
@section('noidung')
<meta name="csrf-token" content="{{ csrf_token() }}">
<h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>
<p class="mb-4">Sản phẩm bán trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách sản phẩm</h6>
		<a href="admin/sanpham/them" class="btn btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm sản phẩm</span>
		</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên SP</th>
						<th>Hình ảnh</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th><i class="fa fa-shopping-cart" aria-hidden="true"></i></th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tên SP</th>
						<th>Hình ảnh</th>
						<th>Giá</th>
						<th>Số lượng</th>
						<th><i class="fa fa-shopping-cart" aria-hidden="true"></i></th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach ($sps as $sp)
					<tr id="{{ $sp->id }}">						
						<th>{{ $sp->id }}</th>
						<th>{{ $sp->tensp }}</th>
						<th><img src="upload/sanpham/{{ $sp->hinhanh }}" style="width: 100px;" alt=""></th>
						<th>{{ $sp->gia }}</th>
						<th>{{ $sp->soluong }}</th>
						<th>{{ $sp->rate }}</th>
						<td>
							<div>
								<button type="button" class="btn btn-primary btn-sm btn-circle ml-3 btnxem" data-toggle="modal" data-target="#SeenModal" data-id="{{ $sp->id }}">
									<i class="fa fa-eye" aria-hidden="true" data-id=""></i>
								</button>
								<a href="admin/sanpham/sua/{{ $sp->id  }}"  class="btn btn-primary btn-sm btn-circle ml-2 btnsua">
									<i class="fa fa-pencil-square-o" aria-hidden="true" data-id=""></i>
								</a>
								<button type="button"  class="btn btn-primary btn-sm btn-circle ml-3 btnxoa mt-2" data-id="{{ $sp->id }}">
									<i class="fa fa-trash" aria-hidden="true" data-id=""></i>
								</button>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<form id="form1" action="admin/sanpham/danhsach/them" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">			
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Thông tin sản phẩm</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					{{-- <button type="submit" class="btn btn-primary" id="btnedit">Lưu</button> --}}
					<input type="submit" class="btn btn-primary" id="btninsert" value="Thêm" >
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal fade" id="SeenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="txtTDseen"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="txtbodyseen"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
	$("#dataTable").on('click','.btnxem',function(){
		$a = $(this).data('id');
		$.get('admin/sanpham/danhsach/'+$a,function(data){
			$("#txtTDseen").text("Chi tiết của " + data["tensp"]);
			$("#txtbodyseen").html(data["chitiet"]);
		});
	});
	$('#form1').on('submit', function(event) {
		event.preventDefault();
		$dm = $('#txtdm').val();
		$ldm = $('#txtldm').val();
		$tb = $('#txttb').val();
		$tsp = $('#txttsp').val();
		$ha = $('#txtha').val();
		$gia = $('#txtgia').val();
		$sl = $('#txtsl').val();
		$nd = CKEDITOR.instances.demo.getData();
		console.log(kttrong($tsp)+'  '+kttrong($ha)+'  '+ktso($gia)+'  '+ktso($sl));
		if(kttrong($tsp)==true&kttrong($ha)==true&ktso($gia)==true&ktso($sl)==true){
			$('#tbtsp').text('');
			$('#tbha').text('');
			$('#tbgia').text('');
			$('#tbsl').text('');
			$a = $ha.split('.');
			$b = ["jpg","gif","png"];
			if(in_array($b,$a[1].toLowerCase())){
				$('#tbha').text('');
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					enctype: 'multipart/form-data',
					url: 'admin/sanpham/danhsach/them',
					method: 'POST',
					cache: false,
					contentType: 'multipart/form-data',
					processData: false,
					data: $("#form1").serialize(),
					success:function(data){
						if(data['success']){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: data['tb'],
								showConfirmButton: false,
								timer: 2000,
								timerProgressBar: true
							});
							setTimeout(function(){
								window.location = window.location.pathname;
							},2000);
						}
						else{
							Swal.fire({
								position: 'top-end',
								icon: 'error',
								title: data['tb'],
								showConfirmButton: false,
								timer: 2000,
								timerProgressBar: true
							});
						}
						alert(data);
					},
					erorr:function(e){
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: e,
							showConfirmButton: false,
							timer: 2000,
							timerProgressBar: true
						});
					}
				})
				.done(function() {
					console.log("success");
				})
				.fail(function(e) {
					console.log(e);
				})
				.always(function() {
					console.log("complete");
				});
			}
			else{
				$('#tbha').text('Chỉ nhập được file có đuôi .jpg, .gif, .png');
			}
		}
		else{
			if(kttrong($tsp)){
				$('#tbtsp').text('');
			}
			else{				
				$('#tbtsp').text('Không để trống');
			}
			if(kttrong($ha)){
				$('#tbha').text('');
				$a = $ha.split('.');
				if(in_array($b,$a[1].toLowerCase())){
					$('#tbha').text('');
				}
				else{
					$('#tbha').text('Chỉ nhập được file có đuôi .jpg, .gif, .png');
				}
			}
			else{				
				$('#tbha').text('Không để trống');
			}
			if(ktso($gia)){				
				$('#tbgia').text('');
			}
			else{
				$('#tbgia').text('Nhập số và không để trống');
			}
			if(ktso($sl)){
				$('#tbsl').text('');
			}
			else{			
				$('#tbsl').text('Nhập số và không để trống');
			}
		}
	});
	// $('#form1').on('submit', function(event) {
	// 	event.preventDefault();
	// 	/* Act on the event */
	// 	$.ajax({
	// 		url: 'admin/sanpham/danhsach/them',
	// 		type: 'POST',
	// 		Content-Type: 'multipart/form-data',
	// 		data: $("#form1").serialize(),
	// 		success:function(data){
	// 			alert(data);
	// 		},
	// 		erorr:function(data){
	// 			alert('that bai');
	// 		}
	// 	})
	// 	.done(function() {
	// 		console.log("success");
	// 	})
	// 	.fail(function(e) {
	// 		console.log(e);
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
		
	// });
	$('#btnthem').click(function(event) {
		/* Act on the event */
		$('#btninsert').show();
		$('#btnedit').hide();
		$.get('admin/ajax/danhmuc',function(data){
			$('#txtdm').html(data);			
			$('#txtldm').html('<option>Bạn chưa chọn danh mục</option>');
		});
	});
	$('.btnsua').click(function(event) {
		/* Act on the event */
			$('#btninsert').hide();
			$('#btnedit').show();
		$.get('admin/ajax/danhmuc',function(data){
			$('#txtdm').html(data);			
			$('#txtldm').html('<option>Bạn chưa chọn danh mục</option>');
		});
	});
	$("#dataTable").on('click', '.btnxoa', function(event) {
		event.preventDefault();
		/* Act on the event */
		$id = $(this).data('id');
		Swal.fire({
			title: 'Bạn chắc chắn muốn xóa sản phẩm này?',
			text: "Xóa rồi không thể khôi phục!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Chắc chắn'
		}).then((result) => {
			if (result.value) {
				$.get('admin/sanpham/xoa/'+$id,function(data){
					if(data){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Xoá thành công',
							showConfirmButton: false,
							timer: 1500
						});
						$("#"+$id).remove();
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Xoá thất bại',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
			}
		})
	});
</script>
@endsection
