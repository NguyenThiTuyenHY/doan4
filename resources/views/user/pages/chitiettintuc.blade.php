@extends('user.layout.tintuc')
@section('content')
<h5 class="text-center">{{ $tt->tieude }}</h5>
<br>
<div style="display: none;" id="ttid">{{ $tt->id }}</div>
<div class="row mt-3">
	<div class="col-5">
		<img src="./upload/tintuc/{{ $tt->hinhanh }}" alt="" style="width: 250px; ">
		<div class="row">
			<div class="col-8 text-black-50"><i class="fa fa-calendar" aria-hidden="true">&nbsp;&nbsp;{{ $tt->ngaydang }}</i></div>
      		<div class="col-4 text-black-50"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;{{ $tt->luotxem }}</div>
		</div>
	</div>
	<div class="col-7">
		<div>
			{{ $tt->tomtat }}
		</div>
	</div>
</div>
<br>
<hr>
<br>
<div class="row">
	<?php echo html_entity_decode($tt->chitiet); ?>
</div>
@endsection
@section('script')
<script>
	$b = 0;
	$(window).scroll(function(event) {
		/* Act on the event */
		$a = $(this).scrollTop();
		if($b==0&&$a>300){
			$c = $("#ttid").text();
			$.get('user/phuongtien/tangluotxem/'+$c,function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Cảm ơn bạn đã xem bài viết!!',
						showConfirmButton: false,
						timer: 3000
					})
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'erorr',
						title: 'Lỗi rồi',
						showConfirmButton: false,
						timer: 1500
					})
				}
			})
			$b = 1;
		}
	});
</script>
@endsection