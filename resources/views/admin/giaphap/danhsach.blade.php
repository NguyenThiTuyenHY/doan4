@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Các phương tiện</h1>
<p class="mb-4">Các phương tiện gồm: dịch vụ, giải pháp, tin tức</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách giải pháp</h6>
		<a href="admin/tintuc/them" class="btn btn-primary btn-icon-split">
			<span class="icon text-white-50">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</span>
			<span class="text">Thêm các phương tiện</span>
		</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Mã</th>
						<th>Tiêu đề</th>
						<th>Hình ảnh</th>
						<th>Loại</th>
						<th>Chức năng</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Mã</th>
						<th>Tiêu đề</th>
						<th>Hình ảnh</th>
						<th>Loại</th>
						<th>Chức năng</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach ($tts as $tt)
					@if($tt->loaitheloai->theloai->id == 2)
					<tr>
						<td>{{ $tt->id }}</td>
						<td>{{ $tt->tieude }}</td>
						<td><img src="upload/tintuc/{{ $tt->hinhanh }}" alt="" style="width: 100px;"></td>
						<td>{{ $tt->loaitheloai->tenltl }}</td>
						<td>
							<div class="row">
								<button type="button" class="btn btn-primary btn-sm btn-circle ml-3 btnxem"  data-toggle="modal" data-target="#seenModal" data-id="{{ $tt->id }}">
									<i class="fa fa-eye" aria-hidden="true" data-id=""></i>
								</button>
								<a href="admin/tintuc/sua/{{ $tt->id }}" class="btn btn-primary btn-sm btn-circle ml-2 btnsua" data-id="">
									<i class="fa fa-pencil-square-o" aria-hidden="true" data-id=""></i>
								</a>
								<button type="button"  class="btn btn-primary btn-sm btn-circle ml-2 btnxoa">
									<i class="fa fa-trash" aria-hidden="true" data-id=""></i>
								</button>
							</div>
						</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="seenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="seenModalTD"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row" style="border-bottom: solid rgba(0,0,0,.5) .5px;">
      		<div class="col-6" >
      			<div id="seenModalHA"></div>
      			<div class="row mt-3">
      				<div class="col-6"><i class="fa fa-calendar" aria-hidden="true"></i> <span id="seenModalND"></span></div>
      				<div class="col-6"><i class="fa fa-eye" aria-hidden="true"></i> <span id="seenModalLX"></span></div>
      			</div>
      		</div>
      		<br>
      		<div class="col-6 " id="seenModalTT">
      			
      		</div>
      	</div>
      	<div id="seenModalCT">
      		
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
	$("#dataTable").on('click', '.btnxem', function(event) {
		// event.preventDefault();
		/* Act on the event */
		$a = $(this).data('id');
		$.get('admin/tintuc/gettt/'+$a,function(data){
			$('#seenModalTD').text(data["tieude"]);
			$('#seenModalND').text(data["ngaydang"]);
			$('#seenModalLX').text(data["luotxem"]);
			$('#seenModalHA').html('<img src="upload/tintuc/'+data["hinhanh"]+'" alt="" style="width: 250px;">');
			$('#seenModalTT').html(data["tomtat"]);
			$('#seenModalCT').html(data["chitiet"]);
		});
	});
	$("#dataTable").on('click', '.btnxoa', function(event) {
		// event.preventDefault();
		/* Act on the event */
		$a = $(this).data('id');
		alert($a);
	});
</script>
@endsection