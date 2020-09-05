@extends('admin.layout.index')
@section('noidung')
<link rel="stylesheet" href="./user/css/style.css">
<h1 class="h3 mb-2 text-gray-800">Rate & bình luận</h1>
<p class="mb-4">Rate & bình luận trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách Rate & bình luận</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<div class="accordion">	
			@foreach ($sps as $sp)			
				<div class="accordion__item">
					<div class="accordion__item__header">
						{{ $sp->id }}.  <img src="./upload/sanpham/{{ $sp->hinhanh }}" style="width: 100px;" alt=""><span class="ml-2">{{ $sp->tensp }}</span><span class="badge badge-light ml-1">{{ count($sp->rating) }}</span>
					</div>

					<div class="accordion__item__content">
						<p>
							{{-- @foreach($sp->rate as $rate)
							@endforeach --}}
							@if(count($sp->rating)>0)
							@foreach($sp->rating as $rate)
							<div class="media" style="border-bottom: solid rgba(0,0,0,.5) .5px; overflow-x: hidden;">
								<img src="./upload/user/{{ $rate->user->hinhanh }}" class="mr-3" alt="..." style="width: 50px;">
								<div class="media-body">
									<div class="row">
										<div class="col-11">
											<h5 class="mt-0">{{ $rate->user->tentaikhoan }}</h5>
											{{-- <div>Đánh giá: {{ $rate->rate }} <img src="https://img.icons8.com/material-rounded/20/FFFF00/star.png"/></div> --}}
											<ul style="list-style: none; padding: 0px;">
												@for($i=1;$i<=$rate->rate;$i++)
												<li style="float: left;"><img src="https://img.icons8.com/material-rounded/20/FFFF00/star.png"/></li>
												@endfor
											</ul>
											<div style="clear: left;"><img src="https://img.icons8.com/windows/20/000000/comments.png"/>: {{ $rate->binhluan }}</div>
											<div><small>{{ date('d-m-Y',strtotime($rate->created_at))}}</small></div>
											<br>
										</div>
										<div class="col-1 mt-2">
											@if($rate->trangthai == 1)
												<button type="button" id="btn_{{ $rate->id }}" data-id="{{ $rate->id }}" data-tt="1" class="chuyentt btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button>
											@else
												<button type="button" id="btn_{{ $rate->id }}" data-id="{{ $rate->id }}" data-tt="2" class="chuyentt btn btn-danger"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
											@endif
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="text-center text-black-50">Không có bình luận nào cho sản phẩm này</div>
							@endif
						</p>  
					</div>
				</div>
			@endforeach
			</div>
			{{ $sps->links() }}
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="./user/js/accordion.js" type="text/javascript" charset="utf-8" async defer></script>	
<script>
	// $(".btn").click(function(event) {
	// 	/* Act on the event */
	// 	$b = $(this).data('id');
	// 	$a = $("#"+$b+"_7").attr('data-tt');	
	// 	$.get("admin/khachhang/trangthai/"+$b+"/"+$a,function(data){
	// 		if(data){
	// 			Swal.fire({
	// 				position: 'top-end',
	// 				icon: 'success',
	// 				title: 'Cập nhật trạng thái khách hàng thành công',
	// 				showConfirmButton: false,
	// 				timer: 2000,
	// 				timerProgressBar: true
	// 			});
	// 			if($a==1){
	// 				$("#"+$b+"_7").attr('data-tt',2);
	// 				$("#"+$b+"_7").attr('class','btn badge badge-danger');
	// 				$("#"+$b+"_7").html('<i class="fa fa-lock fa-2x" aria-hidden="true"></i>');
	// 			}
	// 			if($a==2){
	// 				$("#"+$b+"_7").attr('data-tt',1);
	// 				$("#"+$b+"_7").attr('class','btn badge badge-info');
	// 				$("#"+$b+"_7").html('<i class="fa fa-unlock fa-2x" aria-hidden="true"></i>');
	// 			}
	// 		}
	// 		else{
	// 			Swal.fire({
	// 				position: 'top-end',
	// 				icon: 'error',
	// 				title: 'Cập nhật trạng thái của khách hàng thất bại',
	// 				showConfirmButton: false,
	// 				timer: 3000,
	// 				timerProgressBar: true
	// 			});
	// 		}
	// 	});		
	// });
	$(".chuyentt").click(function(event) {
		/* Act on the event */
		$id = $(this).data('id');
		$tt = $(this).data('tt');
		$.get('admin/rate/chuyentt/'+$id+'/'+$tt,function(data){
			if(data.success){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: 'Chuyển trang thái thành công',
					showConfirmButton: false,
					timer: 1500
				});
				if(data.tt == 1){
					$("#btn_"+ $id).attr('data-tt',1);
					$("#btn_"+ $id).attr('class', 'chuyentt btn btn-success');
					$("#btn_"+ $id).html('<i class="fa fa-eye" aria-hidden="true"></i>');
				}
				else{
					$("#btn_"+ $id).attr('data-tt',2);
					$("#btn_"+ $id).attr('class', 'chuyentt btn btn-danger');
					$("#btn_"+ $id).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
				}
			}
			else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: 'Chuyển trạng thái thất bại',
					showConfirmButton: false,
					timer: 1500
				})
			}
		});
	});
</script>
@endsection