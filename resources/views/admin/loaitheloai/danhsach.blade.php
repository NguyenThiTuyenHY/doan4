@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Loại thể loại</h1>
<p class="mb-4">loại thể loại trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách loại thể loại</h6>
		<button type="button" class="btn btn-primary btn-icon-split" id="btninsert" data-toggle="modal" data-target="#Modal1">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm loại thể loại</span>
		</button>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên loại</th>
						<th>Thể loại</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tên loại</th>
						<th>Thể loại</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody>
          @foreach($ls as $l)
					<tr id="{{ $l->id }}">						
            <td>{{ $l->id }}</td>
            <td id="{{ $l->id }}_1">{{ $l->tenltl }}</td>
            <td id="{{ $l->id }}_2">{{ $l->theloai->tentl }}</td>
            <td>
              <div class="row">
                <button id="{{  $l->id }}_3" class="btn btn-primary btn-sm btn-circle ml-3 btnedit" data-id="{{ $l->id }}" data-toggle="modal" data-target="#Modal1">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button id="{{  $l->id }}_4" class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="{{ $l->id }}">
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
        <h5 class="modal-title" id="exampleModalLabel">Thông tin loại thể loại</h5>
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
      				<label for="txtdm">Danh mục</label>
      				<select class="form-control" id="txtdm">
      					@foreach($th as $item)                 
                  <option value="{{ $item->id }}">{{ $item->tentl }}</option>
                @endforeach
      				</select>
            </div>
      		</div>
      		<div class="col-lg-6">
      			<div class="form-group">
      				<label for="txtten">Tên loại danh mục</label>
      				<input type="text" class="form-control" id="txtten">
              <small style="color: red;" id="tbldm"></small>
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
  $(document).ready(function() {
    $('#dataTable').on('click', '.btnedit', function() {
      $("#tbldm").text('');
      $('#txtid').val($(this).data('id'));
      $('#txtdm').val($('#'+$(this).data('id')+'_2').text());
      $('#txtten').val($('#'+$(this).data('id')+'_1').text());
      $('#btnthem').hide();
      $('#btnsua').show();
      $a =  $(this).data('id')+ '_2';
      $.get('admin/ajax/laytheloai/'+$("#"+$a).text(),function(data){
      $('#txtdm').html(data);
      });
    });
    $('#btnsua').click(function(event) {
      if(kttrong($('#txtten').val())){
        $('#tbldm').text('');
        $a = $('#txtid').val();
        $c = $('#txtdm').val();
        $b = $('#txtten').val();
        $.get('admin/loaitheloai/sua/'+$a+'/'+$b+'/'+$c,function(data){
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
            $('#' + $a +'_2').text(data["tendm"]);
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
        $('#tbldm').text('Không được để trống');
      }
    });
    $('#dataTable').on('click','.btndelete',function(){
      Swal.fire({
        title: 'Bạn chắc chắc xóa dữ liệu này?',
        text: "Xóa rồi sẽ không khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa'
      }).then((result) => {
        if (result.value) {
          $a = $(this).data('id');
          $.get('admin/loaitheloai/xoa/' + $(this).data('id'),function(data){
            $('#Modal1').modal("hide"); 
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
            'Hủy!',
            'Loại danh mục của bạn được giữa lại.',
            'info'
            )
        }
      });
    });
    $('#btninsert').click(function(event) {
      $("#tbldm").text('');
      $("#txtten").val('');    
      $('#btnsua').hide();
      $('#btnthem').show();
    });
    $('#btnthem').click(function(event) {
      /* Act on the event */
      $("#tbldm").text('');
      $a = $("#txtdm").val(); 
      $b = $("#txtten").val();
      if(kttrong($('#txtten').val())){
        $.get('admin/loaitheloai/them/'+$b+'/'+$a,function(data){
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
        $("#tbldm").text('Không để trống');
      }
    });
  });
</script>
@endsection