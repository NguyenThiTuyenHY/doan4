@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Danh mục</h1>
<p class="mb-4">danh mục bán trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách danh mục</h6>
		<button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#Modal1" id="btninsert">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm danh mục</span>
		</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên danh mục</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tên danh mục</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody id="bodytable">
					@foreach($dm as $item)
					<tr id="{{ $item->id }}">						
						<td id="{{ $item->id }}_1">{{ $item->id }}</td>
						<td id="{{ $item->id }}_2">{{ $item->tendm }}</td>
						<td>
							<div class="row">
								<button type="button" id="{{ $item->id }}_3" data-toggle="modal" data-target="#Modal1" data-id="{{ $item->id }}"  class="btn btn-primary btn-sm btn-circle ml-3 btnedit">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
								<button id="{{ $item->id }}_4" type="button" class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id='{{ $item->id }}'>
									<i class="fa fa-trash" aria-hidden="true"></i>
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
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin danh mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group" style="display: none;">
      		<label for="txtten">ID</label>
      		<input type="text" class="form-control" id="txtid">
      	</div> 
      	<div class="form-group">
      		<label for="txtten">Tên danh mục</label>
      		<input type="text" class="form-control" id="txtdm">
      		<small style="color: red;" id="tbdm"></small>
      	</div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="btnsua">Lưu</button>
        <button type="button" class="btn btn-primary" id="btnthem">Thêm</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		$('#btninsert').click(function(event) {
			$("#tbdm").text('');
			$('#txtdm').val('');
			$('#btnsua').hide();
			$('#btnthem').show();
		});
		$('.btnedit').click(function(event) {
			$("#tbdm").text('');
			$('#txtid').val($(this).data('id'));
			$('#txtdm').val($('#'+$(this).data('id')+'_2').text());
			$('#btnthem').hide();
			$('#btnsua').show();
		});
		$('.btndelete').click(function(event) {
			/* Act on the event */
			Swal.fire({
				title: 'Bạn chắc xóa danh mục này?',
				text: "Xóa rồi không thể khôi phục danh mục!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Xóa'
			}).then((result) => {
				$('#Modal1').modal("hide");	
				if (result.value) {
					$a = $(this).data('id');
					$.get('admin/danhmuc/xoa/'+$(this).data('id'),function(data){
						if(data){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'xóa thành công',
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true
							});
							$('#' + $a).remove();
						}
						else{
							Swal.fire({
								position: 'top-end',
								icon: 'error',
								title: 'xóa thất bại',
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true
							});
						}
					});
				}
				else{
					Swal.fire(
						'Hủy',
						'Xóa thất bại',
						'error'
					)
				}
			});
		});
		$('#btnsua').click(function(event) {
			/* Act on the event */
			if(kttrong($('#txtdm').val())){
				$("#tbdm").text('');
				$.get('admin/danhmuc/sua/'+$('#txtid').val()+'/'+$('#txtdm').val(),function(data){
					$('#Modal1').modal("hide");	
					if(data){										
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'sửa thành công',
							showConfirmButton: false,
							timer: 2000,
							timerProgressBar: true
						});	
						$('#' + $('#txtid').val()+'_2').text($('#txtdm').val());
						$('#' + $('#txtid').val()+'_3').attr('data-ten',$('#txtdm').val());	
					}
					else{
						Swal.fire({
							position: 'top-end',
							icon: 'error',
							title: 'sửa thất bại',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true
						});
					}
				});
			}
			else{
				$("#tbdm").text('Không để trống');
			}	

		});
		$('#btnthem').click(function(event) {
			/* Act on the event */
			if(kttrong($('#txtdm').val())){
				$("#tbdm").text('');
				$.get('admin/danhmuc/them/'+$('#txtdm').val(),function(data){
					if(data){
						$('#Modal1').modal("hide");	
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'thêm thành công',
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
							title: 'thêm thất bại',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true
						});
					}
				});	
			}
			else{
				$("#tbdm").text('Không để trống');
			}		
		});
	});
</script>
@endsection