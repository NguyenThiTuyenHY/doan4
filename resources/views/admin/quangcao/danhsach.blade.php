@extends('admin.layout.index')
<meta name="_token" content="{{ csrf_token() }}">
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Quảng cáo</h1>
<p class="mb-4">Quảng cáo trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách quảng cáo</h6>
		<button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#Modal1" id="btninsert">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm quảng cáo</span>
		</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			@if(count($qcs)>0)
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tiêu đề</th>
						<th>Hình ảnh</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tiêu đề</th>
						<th>Hình ảnh</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody id="bodytable">
					@foreach($qcs as $qc)
					<tr id="{{ $qc->id }}">						
						<td id="{{ $qc->id }}_1">{{ $qc->id }}</td>
						<td id="{{ $qc->id }}_2">{{ $qc->tieude }}</td>
						<td id="{{ $qc->id }}_3"><img src="./upload/quangcao/{{ $qc->hinhanh }}" alt="" style="width: 100px;"></td>
						<td>
							<div class="row">
								<button type="button" data-toggle="modal" data-target="#Modal2"  data-id="{{ $qc->id }}"  class="btn btn-primary btn-sm btn-circle ml-3 btnedit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
								<button type="button" class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id='{{ $qc->id }}'>
									<i class="fa fa-trash" aria-hidden="true"></i>
								</button>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@else
			<div class="alert alert-primary text-center">Chưa có quảng cáo nào</div>
			@endif
		</div>
	</div>
</div>
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		@csrf
		@method('POST')
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thông tin quảng cáo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group" style="display: none;">
					<label for="txtidsua">ID</label>
					<input type="text" class="form-control" id="txtidsua" name="txtidsua">
				</div> 
				<div class="form-group">
					<label for="txttieudesua">Tiêu đề</label>
					<input type="text" class="form-control" id="txttieudesua" name="txttieudesua">
				</div>     
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn btn-primary" id="btnsua">Sửa</button>
			</div>
		</div>
	</div>
</div>
<form id="frminsert">
	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
		<div class="modal-dialog" role="document">
			@csrf
			@method('POST')
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Thông tin quảng cáo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group" style="display: none;">
						<label for="txtid">ID</label>
						<input type="text" class="form-control" id="txtid" name="txtid">
					</div> 
					<div class="form-group">
						<label for="txttieude">Tiêu đề</label>
						<input type="text" class="form-control" id="txttieude" name="txttieude">
					</div>  
					<div class="form-group">
						<label for="txthinhanh">Hình ảnh</label>
						<input type="file" class="form-control-file" id="txthinhanh" name="txthinhanh">
					</div>     
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary" id="btnthem">Thêm</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@section('script')
<script>
	$("#frminsert").on('submit', function(event) {
		$.ajaxSetup({
			headers: {
				'X-XSRF-Token': $('meta[name="_token"]').attr('content')
			}
		});
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: '{{ route("quangcao.them") }}',
			type: 'POST',
			dataType: 'json',
			data: new FormData($("#frminsert")[0]),
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
					timer: 2000
					});
					$('#Modal1').modal('hide');
					$str = '<tr id="'+data.quangcao.id+'">	';					
					$str += '	<td id="'+data.quangcao.id+'_1">'+data.quangcao.id+'</td>';
					$str += '	<td id="'+data.quangcao.id+'_2">'+data.quangcao.tieude+'</td>';
					$str += '	<td id="'+data.quangcao.id+'_3"><img src="./upload/quangcao/'+data.quangcao.hinhanh+'" alt="" style="width: 100px;"></td>';
					$str += '	<td>';
					$str += '		<div class="row">';
					$str += '			<button type="button" id="_3" data-toggle="modal" data-target="#Modal1" data-id="'+data.quangcao.id+'"  class="btn btn-primary btn-sm btn-circle ml-3 btnedit">';
					$str += '				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
					$str += '			</button>';
					$str += '			<button id="'+data.quangcao.id+'_4" type="button" class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="'+data.quangcao.id+'">';
					$str += '				<i class="fa fa-trash" aria-hidden="true"></i>';
					$str += '			</button>';
					$str += '		</div>';
					$str += '	</td>';
					$str += '</tr>';
					$('#bodytable').append($str);
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: data.thongbao,
						showConfirmButton: false,
						timer: 2000
					});
				}
			},
			error:function(data){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Your work has been saved',
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
	$('#dataTable').on('click', '.btndelete', function(event) {
		event.preventDefault();
		/* Act on the event */
		
		Swal.fire({
			title: 'Bạn có chắc chắn?',
			text: "Xóa quảng cáo đi rồi bạn sẽ không khôi phục được",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Chắc chắn!'
		}).then((result) => {
			if (result.value) {
				$.get('admin/quangcao/xoaquangcao/'+$(this).data('id'),function(data){
					if(data.success){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Xóa quảng cáo thành công',
							showConfirmButton: false,
							timer: 1500
						});
						$('#'+$(this).data('id')).remove();
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'Xóa quảng cáo thất bại',
							showConfirmButton: false,
							timer: 2000
						});
					}
				});
			}
		})
	});
	$('#dataTable').on('click', '.btnedit', function(event) {
		event.preventDefault();
		/* Act on the event */
		$id = $(this).data('id');
		$tieude = $("#"+$id+"_2").text();
		$("#txtidsua").val($id);
		$("#txttieudesua").val($tieude);
		
	});
	$("#btnsua").click(function(event) {
		/* Act on the event */
		$.get('admin/quangcao/suaquangcao/'+$("#txtidsua").val()+'/'+$("#txttieude").val(),function(data){
			if(data.success){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Sửa quảng cáo thành công',
					showConfirmButton: false,
					timer: 1500
				});
				$("#"+$("#txtidsua").val()+"_2").text($("#txttieudesua").val());
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Sửa quảng cáo thất bại',
					showConfirmButton: false,
					timer: 2000
				});
			}
		});
	});
</script>
@endsection