@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Phân loại</h1>
<p class="mb-4">Phân loại các loại danh mục trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách phân loại</h6>
		<button type="button" class="btn btn-primary btn-icon-split" id="btninsert" data-toggle="modal" data-target="#Modal1">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm phân loại</span>
		</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên phân loại</th>
						<th>Loại danh mục</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
            <th>Tên phân loại</th>
            <th>Loại danh mục</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody>
          @foreach($pls as $pl)
					<tr id="{{  $pl->id}}">						
            <td>{{ $pl->id }}</td>
            <td id="{{  $pl->id }}_1">{{ $pl->tenpl }}</td>
            <td id="{{  $pl->id }}_2">{{ $pl->loaidanhmuc->tenldm }}</td>
            <td>
              <div class="row">
                <button id="{{  $pl->id }}_3" class="btn btn-primary btn-sm btn-circle ml-3 btnedit" data-id="{{ $pl->id }}" data-toggle="modal" data-target="#Modal1">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button id="{{  $pl->id }}_4" class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="{{ $pl->id }}">
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin phân loại</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-6">
            <div class="form-group" style="display: none;">
              <label for="txtten">ID</label>
              <input type="text" class="form-control" id="txtid">
            </div>
      			<div class="form-group">
      				<label for="txtldm">Loại danh mục</label>
      				<select class="form-control" id="txtldm">
      					@foreach($ls as $l)                 
                  <option value="{{ $l->id }}">{{ $l->tenldm }}</option>
                @endforeach
      				</select>
            </div>
      		</div>
      		<div class="col-lg-6">
      			<div class="form-group">
      				<label for="txtten">Tên phân loại</label>
      				<input type="text" class="form-control" id="txtten">
              <small style="color: red;" id="tbten"></small>
      			</div>
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
  $('#btninsert').click(function(event) {
    $('#txtten').val('');
    $('#btnsua').hide();
    $('#btnthem').show();
  });
  $("#dataTable").on('click', '.btnedit', function(event) {   
    $a = $(this).data('id');
    $b = $('#'+$a+'_1').text();
    $c = $('#'+$a+'_2').text();
    $("#txtid").val($a);
    $('#txtten').val($b);
    $('#btnsua').show();
    $('#btnthem').hide();
    $.get('admin/ajax/getdanhmuctheopl/'+$c,function(data){
      $("#txtldm").html(data);
    });
  });
   $('#btnsua').click(function(event) {
    $a = $('#txtid').val();
    $c = $('#txtldm').val();
    $b = $('#txtten').val();
    $.get('admin/phanloai/sua/'+$a+'/'+$b+'/'+$c,function(data){
      $('#Modal1').modal("hide"); 
      if(data["success"]){
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'sửa thành công',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true
        }); 
        $('#' + $a +'_1').text(data["ten"]);
        $('#' + $a +'_2').text(data["tenldm"]);
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
  });
    $('#btnthem').click(function(event) {
      $a = $('#txtid').val();
      $c = $('#txtldm').val();
      $b = $('#txtten').val();
      $.get('admin/phanloai/them/'+$b+'/'+$c,function(data){
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
  });
  $("#dataTable").on('click', '.btndelete', function(event) {   
    $a = $(this).data('id');
    $.get('admin/phanloai/xoa/'+$a,function(data){
      if(data){
        $('#Modal1').modal("hide"); 
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'xóa thành công',
          showConfirmButton: false,
          timer: 2000,
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
  });
</script>
@endsection