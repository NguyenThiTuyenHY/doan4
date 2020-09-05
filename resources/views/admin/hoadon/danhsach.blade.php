@extends('admin.layout.index')
@section('noidung')
<link rel="stylesheet" href="./user/css/style.css">
<h1 class="h3 mb-2 text-gray-800">Hóa đơn nhập</h1>
<p class="mb-4">Hóa đơn nhập trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<div class="col-8">
			<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách hóa đơn nhập</h6>
		</div>
		<div class="col-2">
			<button type="button" class="btn btn-primary txtlammoi" data-toggle="modal" data-target="#insertModal">Thêm hóa đơn</button>
		</div>
		<div class="col-2">
			<form action="{{ route('hoadon.xuatexcel') }}" method="POST">
				@csrf
				<input type="submit" value="Xuất Excel" name="export_csv" class="btn btn-success">
			</form>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			@if(count($hds)>0)
			<div class="accordion">	
			@foreach ($hds as $hd)			
				<div class="accordion__item" id="{{ $hd->id }}">
					<div class="accordion__item__header">
						<div>Mã hóa đơn {{ $hd->id }}</div>
					</div>

					<div class="accordion__item__content">
						<p>
							{{-- @foreach($sp->rate as $rate)
							@endforeach --}}
							{{-- @foreach($hds as $hd) --}}
							<h4 class="text-center">Hóa đơn nhập</h4>
							<table class="table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Tên đơn vị</th>
										<th>Địa chỉ</th>
										<th>Số điện thoại</th>
										<th>Ngày tháng</th>
										<th>Thành tiền</th>
										<th>Chức năng</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{ $hd->id }}</td>
										<td>{{ $hd->tendonvi }}</td>
										<td>{{ $hd->diachi }}</td>
										<td>{{ $hd->sodienthoai }}</td>
										<td>{{ date('d-m-Y',strtotime($hd->ngaynhap)) }}</td>
										<td>{{ number_format($hd->thanhtien) }}</td>
										<td>
											<button class="btn btn-primary btn-sm btn-circle ml-2 btndelete" data-id="{{ $hd->id }}" data-toggle="modal" data-target="#deleteModal">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</button>
											<a target="_blank" href="admin/hoadon/inhoadon/{{$hd->id}}" class="btn btn-primary btn-sm btn-circle ml-2 btnprint">
												<i class="fa fa-print" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
								</tbody>
							</table>
							<h4 class="text-center">Chi tiết hóa đơn</h4>
							<form id="frmchitiet_{{ $hd->id }}">
								@csrf
								@method('POST')
								<table class="table" id="table_{{ $hd->id }}">
								<thead>
									<tr>
										<th>STT</th>
										<th>Sản phẩm</th>
										<th>Đơn giá</th>
										<th>Số lượng</th>
									</tr>
								</thead>
								<tbody id="body_{{ $hd->id }}">
									<?php $t = 1; ?>
									@foreach($hd->chitiethoadon as $ct)
									<tr>
										<td>{{ $t++ }}</td>
										<td>{{ $ct->sanpham->tensp }}</td>
										<td>{{ number_format($ct->dongia) }}</td>
										<td>{{ $ct->soluong }}</td>
									</tr>
									@endforeach								
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4" align="center">
											<button data-id="{{ $hd->id }}" type="button" class="btn btn-danger btnthemcthd"><i class="fa fa-plus" aria-hidden="true"></i></button>
											<button data-id="{{ $hd->id }}" type="submit" class="btn btn-success mt-2" id="btninsertcthd_{{ $hd->id }}" style="display: none;"><i class="fa fa-check" aria-hidden="true"></i></button>
										</td>
									</tr>
								</tfoot>
							</table>
							</form>
							{{-- @endforeach --}}
						</p>  
					</div>
				</div>
			@endforeach
			</div>
			{{ $hds->links() }}
			@else
			<div class="alert alert-primary text-center">Hiện tại không có hóa đơn nào</div>
			@endif
		</div>
	</div>
</div>
<form id="forminsert">
	<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Thông tin hóa đơn</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-6">
							<h5 class="text-center">Hóa đơn</h5>
							<div class="form-group" style="boder: dashed;">
								<label for="txtncc">Nhà cung cấp</label>
								<select class="form-control" id="txtncc" name="txtncc">
									<option value="0">Chọn nhà cung cấp(nếu có)</option>
								</select>
							</div>
							<div class="form-group">
								<label for="txttenncc">Tên đơn vị</label>
								<input type="text" class="form-control" id="txttenncc" name="txttenncc">
							</div>
							<div class="form-group">
								<label for="txtdiachincc">Địa chỉ</label>
								<input type="text" class="form-control" id="txtdiachincc" name="txtdiachincc">
							</div>
							<div class="form-group">
								<label for="txtsdtncc">Số điện thoại</label>
								<input type="text" class="form-control" id="txtsdtncc" name="txtsdtncc">
							</div>
						</div>
						<div class="col-6">
							<h5 class="text-center">Chi tiết hóa đơn</h5>
							<div class="form-group">
								<label for="">Sản phẩm</label>
								<select class="form-control" id="txtsanpham" name="txtsanpham">
									<option value="0">Chọn sản phẩm</option>
								</select>
							</div>
							<div class="form-group">
								<label for="txtdongia">Đơn giá</label>
								<input type="text" class="form-control" id="txtdongia" name="txtdongia">
							</div>
							<div class="form-group">
								<label for="txtsoluong">Số lượng</label>
								<input type="number" class="form-control" min="0" id="txtsoluong" name="txtsoluong">
							</div>
							<button type="button" class="btn btn-primary" id="themchitietdonhang">Thêm tiết hóa đơn</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary txtlammoi">Làm mới</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="sunmit" class="btn btn-primary">Thêm</button>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa hóa đơn này?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="display: none;">
					<input type="hidden" name="" value="" id="txtiddelete">
				</div>
				<div class="modal-footer">
					<button type="sunmit" class="btn btn-primary btnxoa" data-id="0">Xóa, không giảm số lượng</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
<script src="./user/js/accordion.js" type="text/javascript" charset="utf-8" async defer></script>
<script>
	$click = 0;
	$("#txtsanpham").click(function(event) {
		/* Act on the event */
		if($click==0){
			$.get("admin/ajax/sanphamtheohoadon",function(data){
				$("#txtsanpham").html(data);			
			});
			$click = 1;
		}
	});
	$click1=0;
	$("#txtncc").click(function(event) {
		/* Act on the event */
		if($click1==0){
			$.get("admin/ajax/nhacungcaptheohoadon",function(data){
				$("#txtncc").html(data);			
			});
			$click1 = 1;
		}
		if($click1==1){
			$id = $(this).val();
			if($id>0){
				$.get("admin/ajax/nhacungcaptheohoadonmancc/"+$id,function(data){
					$('#txttenncc').val(data.ncc.tenncc);
					$('#txtdiachincc').val(data.ncc.diachi)
					$('#txtsdtncc').val(data.ncc.sodienthoai);
				});
			}
		}
	});
	$(".txtlammoi").click(function(){
		$click = 0;
		$click1=0;
		$array=[];
		$('#txtncc').html('<option value="0">Chọn nhà cung cấp(nếu có)</option>');
		$('#txttenncc').val('');
		$('#txtdiachincc').val('')
		$('#txtsdtncc').val('');
		$('#txtsanpham').html('<option>Chọn sản phẩm</option>');
		$('#txtdongia').val('')
		$('#txtsoluong').val('');
	});
	$array=[];
	$("#themchitietdonhang").click(function(){
		$a = $('#txtsanpham').val();
		$b = $('#txtdongia').val();
		$c = $('#txtsoluong').val();
		$array.push([$a,$b,$c]);
		$('#txtdongia').val('');
		$('#txtsoluong').val('');
	});
	$("#forminsert").on('submit', function(event) {
		event.preventDefault();
		$.ajax({
			url: 'admin/hoadon/themhoadon/'+$array,
			type: 'GET',
			dataType: 'json',
			data: $("#forminsert").serialize(),
			success:function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Thêm hóa đơn thành công',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout(function(){
						window.location = window.location.pathname;
					},1500);
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Thêm hóa đơn thất bại',
						showConfirmButton: false,
						timer: 1500
					});
				}
			},
			error:function(data){

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
	$(".btndelete").click(function(event) {
		/* Act on the event */
		$("#txtiddelete").val($(this).data('id'));
	});
	$('.btnxoa').click(function(event) {
		/* Act on the event */
		$id = $("#txtiddelete").val();
		$kieu = $(this).data('id');
		console.log($id);
		console.log($kieu);
		$.get('admin/hoadon/xoahoadon/'+$id+'/'+$kieu,function(data){
			if(data.success){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Xóa hóa đơn thành công',
					showConfirmButton: false,
					timer: 1500
				});
				$("#"+$id).remove();
				$("#deleteModal").modal('hidden');
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Xóa hóa đơn thất bại',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	});	
	$(".btnthemcthd").click(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$a = document.getElementById("body_"+$id);
		$b = $a.getElementsByTagName("tr");
		$str = "<tr>";
		$str += "<td>"+($b.length+1)+"</td>";
		$str += '<td><select class="form-control selectthem" id="spchitiet'+$b.length+'" name="txtsanpham">';
		$str += '	<option value="0">Chọn sản phẩm</option>';
		$str += '	</select></td>';
		$str += "<td><input type='number' class='dongiathem' min='0'></td>";
		$str += "<td><input type='number' class='soluongthem' min='0'></td>";
		$str += "</tr>";
		$("#body_"+$id).append($str);
		$click3 = 0;
		$("#table_"+$id).on('click', '#spchitiet'+($b.length-1), function(event) {
			event.preventDefault();
			if($click3==0){
				$.get("admin/ajax/sanphamtheohoadon",function(data){
					$("#table_"+$id+" #spchitiet"+($b.length-1)).html(data);			
				});
				$click3 = 1;
			}
		});
		$("#btninsertcthd_"+$id).attr("style","display:block");
		$("#frmchitiet_"+$id).on('submit', function(event) {
			event.preventDefault();
			$c = $a.getElementsByClassName("selectthem");
			$d = $a.getElementsByClassName("dongiathem");
			$e = $a.getElementsByClassName("soluongthem");
			$ds = [];
			for(var i =0;i<$c.length;i++){
				$ds.push([$c[i].value,$d[i].value,$e[i].value]);
			}
			$.get('admin/hoadon/insertchitiethoadon/'+$ds+'/'+$id,function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Thêm thành công',
						showConfirmButton: false,
						timer: 1500
					})
					console.log(data.thongbao);
					setTimeout(function() {
						window.location = window.location.pathname;
					}, 1500);
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Thêm thất bại',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		});
	});	
</script>
@endsection