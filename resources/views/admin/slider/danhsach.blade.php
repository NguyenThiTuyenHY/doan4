@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Slider</h1>
<p class="mb-4">Các slider trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách slider</h6>
		<div><button type="button" id="btnthem" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Thêm slider</button></div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Hình ảnh</th>
						<th>Tiêu đề</th>						
						<th>Chức năng</th>			
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Hình ảnh</th>
						<th>Tiêu đề</th>						
						<th>Chức năng</th>		
					</tr>
				</tfoot>
				<tbody>
					@foreach($sliders as $slider)
					<tr id="{{ $slider->id}}">
						<td id={{ $slider->id}}_1>{{ $slider->id}}</td>
						<td><img src="./upload/slider/{{ $slider->hinhanh}}" style="width: 150px;" alt="" id={{ $slider->id}}_2></td>
						<td id={{ $slider->id}}_3>{{ $slider->tieude}}</td>
						<td><button type="button" class="btn btn-primary btnsua" data-toggle="modal" data-id="{{ $slider->id }}" data-target="#exampleModal"><i class="fa fa-pencil-square" aria-hidden="true"></i></button> <button type="button" class="ml-2 btn btn-primary btnxoa" data-id="{{ $slider->id }}" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label for="txttieude">Tiêu đề</label>
      		<input type="text" class="form-control" id="txttieude" name="txttieude">
      	</div>
      	<div class="form-group">
      		<label for="txthinh">Hình ảnh</label>
      		<input type="file" class="form-control-file" id="txthinh" name="txthinh">
      		<img src="" alt="" id="txtimg" style="margin-top: 10px;width: 150px;">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" id="btnedit" class="btn btn-primary">Lưu</button>
        <button type="button" id="btninsert" class="btn btn-primary">Thêm</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$("#dataTable").on('click', '.btnsua', function(event) {		
		$id = $(this).data('id');
		$("#txttieude").val($("#"+$id+"_3").text());
		$hinh = $("#"+$id+"_2").attr('src');
		$('#txtimg').attr('src',$hinh);
		$("#btninsert").hide();
		$("#btnedit").show();
	});
	$("#btnthem").click(function(event) {
		/* Act on the event */
		$("#txttieude").val("");
		$('#txtimg').attr('src',"");
		$("#btninsert").show();
		$("#btnedit").hide();
	});
</script>
@endsection