@extends('admin.layout.index')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Nhà cung cấp</h1>
<p class="mb-4">Nhà cung cấp trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách nhà cung cấp</h6>
		<button type="button" class="btn btn-primary btn-icon-split" id="btninsert" data-toggle="modal" data-target="#Modal1">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm nhà cung cấp</span>
		</button>
	</div>
	<div class="card-body">
    <div id="form_result"></div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên nhà cung cấp</th>
						<th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tên nhà cung cấp</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody id="tablebody">
          @foreach($nccs as $ncc)
					<tr id="{{ $ncc->id }}">						
            <td id="{{ $ncc->id }}_1">{{ $ncc->id }}</td>
            <td id="{{ $ncc->id }}_2">{{ $ncc->tenncc }}</td>
            <td id="{{ $ncc->id }}_3">{{ $ncc->diachi }}</td>
            <td id="{{ $ncc->id }}_4">{{ $ncc->sodienthoai }}</td>
            <td id="{{ $ncc->id }}_5">{{ $ncc->email }}</td>
            <td>
              <div class="row">
                <button class="btn btn-primary btn-sm btn-circle ml-3 btnedit" data-id="{{ $ncc->id }}" data-toggle="modal" data-target="#Modal1">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="{{ $ncc->id }}">
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
<form id="formexample">
  <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin nhà cung cấp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" class="form-control" id="ma_nha_cung_cap" name="ma_nha_cung_cap">
        </div> 
        <div class="form-group">
          <label for="txtten">Tên nhà cung cấp</label>
          <input type="text" class="form-control" id="ten_nha_cung_cap" name="ten_nha_cung_cap">
        </div>     
      <div class="form-group">
          <label for="txtten">Địa chỉ</label>
          <input type="text" class="form-control" id="dia_chi" name="dia_chi">
        </div> 
      <div class="form-group">
          <label for="txtten">Điện thoại</label>
          <input type="text" class="form-control" id="dien_thoai" name="dien_thoai">
        </div> 
      <div class="form-group">
          <label for="txtten">Email</label>
          <input type="text" class="form-control" id="email" name="email">
        </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <input type="submit" class="btn btn-primary" id="btnchung" name="" value="Thêm">
      </div>
    </div>
  </div>
</div>
</form>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    $('#btninsert').click(function(event) {
      $("#ma_nha_cung_cap").val('');
      $("#ten_nha_cung_cap").val('');
      $("#dia_chi").val('');
      $("#dien_thoai").val('');
      $("#email").val('');
      $('#btnchung').attr('value','Thêm');
    });
    $("#dataTable").on('click', '.btnedit', function(event) {
      event.preventDefault();
      /* Act on the event */
      $a = $(this).data('id');
      $("#ma_nha_cung_cap").val($('#'+$a+'_1').text());
      $("#ten_nha_cung_cap").val($('#'+$a+'_2').text());
      $("#dia_chi").val($('#'+$a+'_3').text());
      $("#dien_thoai").val($('#'+$a+'_4').text());
      $("#email").val($('#'+$a+'_5').text());
      $('#btnchung').attr('value','Sửa');
    });
    $("#formexample").on('submit', function(event) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      event.preventDefault();
      /* Act on the event */
      if($('#btnchung').val()=="Thêm"){
        $.ajax({
          url:"{{ route('nhacungcapthem') }}",
          method:'GET',
          data: $("#formexample").serialize(),
          contentType: false,
          cache: false,
          processData: false,
          dataType:'json',   
          success:function(data){
            var html ="";
            if(data.errors){
              html= "<div class='alert alert-danger'>";
              for(var count =0; count <data.errors.length;count++){
                html+='<p>'+data.errors[count]+'</div>';
              }
              html+="</div>";
            }
            if(data.success){
              html = "";
              $("#Modal1").modal('hide');
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: data.thongbao,
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout(function(){
                window.location = window.location.pathname;
              },2000);
            //   $str = '<tr id="'+data.danhsach.id+'">';           
            // $str +='<td id="'+data.danhsach.id+'_1">'+data.danhsach.id+'</td>';
            // $str +='<td id="'+data.danhsach.id+'_2">'+data.danhsach.tenncc+'</td>';
            // $str +='<td id="'+data.danhsach.id+'_3">'+data.danhsach.diachi+'</td>';
            // $str +='<td id="'+data.danhsach.id+'_4">'+data.danhsach.sodienthoai+'</td>';
            // $str +='<td id="'+data.danhsach.id+'_5">'+data.danhsach.email+'</td>';
            // $str +='<td>';
            // $str +='  <div class="row">';
            // $str +='    <button class="btn btn-primary btn-sm btn-circle ml-3 btnedit" data-id="'+data.danhsach.id+'" data-toggle="modal" data-target="#Modal1">';
            // $str +='      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
            // $str +='    </button>';
            // $str +='    <button class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="'+data.danhsach.id+'">';
            // $str +='     <i class="fa fa-trash" aria-hidden="true"></i>';
            // $str +='    </button>';
            // $str +='  </div>';
            // $str +=' </td> ';  
            // $str +=' </tr>';
            $("#tablebody").append($str);
            }
            $('#form_result').html(html);
          }             
        });
      }
      else{
        $.ajax({
          url:"{{ route('nhacungcapsua') }}",
          method:'GET',
          data: $("#formexample").serialize(),
          contentType: false,
          cache: false,
          processData: false,
          dataType:'json',   
          success:function(data){
            var html ="";
            if(data.errors){
              html= "<div class='alert alert-danger'>";
              for(var count =0; count <data.errors.length;count++){
                html+='<p>'+data.errors[count]+'</div>';
              }
              html+="</div>";
            }
            if(data.success){
              html = "";
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Sửa thành công',
                showConfirmButton: false,
                timer: 1500
              });
                    // document.forms.namedItem("form").reset();
                    // $("#dataTable").DataTale().ajax.reload();
                    $("#Modal1").modal('hide');
                    // setTimeout(function(){
                    //   window.location = window.location.pathname;
                    // },2000);
                    $('#'+data.id+'_2').text(data.tenncc);
                    $('#'+data.id+'_3').text(data.diachi);
                    $('#'+data.id+'_4').text(data.sodienthoai);
                    $('#'+data.id+'_5').text(data.email);
                  }
                  $('#form_result').html(html);
                }             
              });
      }
    });
     $("#dataTable").on('click', '.btndelete', function(event) {
       event.preventDefault();
       /* Act on the event */
       $id = $(this).data('id');
       Swal.fire({
        title: 'Bạn chắc chắn?',
        text: "Xóa rồi sẽ không thể khôi phục lại!!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Chắc chắn'
      }).then((result) => {
        if (result.value) {
          $.get('admin/nhacungcap/xoa/'+$id,function(data){
            if(data){
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Xóa thành công',
                showConfirmButton: false,
                timer: 1500
              });
              $("#"+$id).remove();
            }
            else{
              Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Xóa thất bại',
                showConfirmButton: false,
                timer: 1500
              });
            }
          });
        }
        else{
          Swal.fire(
            'Xoá thất bại',
            'Nhà cung cấp vẫn còn',
            'error'
            )
        }
      })
     });
  });
</script>
@endsection