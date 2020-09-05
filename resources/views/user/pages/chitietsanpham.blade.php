@extends('user.layout.sanpham')
@section('content')
<style>
	/* .ratings{
		display: flex;
		flex-direction: column;
	} */
	.ratings .fa{
		/* background-color: rgba(0,0,0,.5); */
		float: left;
		cursor: pointer;
		color: yellow;
		font-size: 30px;
	}
</style>
<div class="row">
	<div class="col-5">
		<img src="upload/sanpham/{{  $sp->hinhanh }}" alt="" style="width:290;height:290px;">
	</div>
	<div class="col-7 text-black-50" style="list-style-type: none; font-size: 14px;">
		<li class="mt-1"><b>Mã sản phẩm: {{  $sp->id }}</b></li>
		<li class="mt-1"><b>Tên sản phẩm: {{  $sp->tensp }}</b></li>
		<li class="mt-1"><b>Giá: {{ number_format($sp->gia) }} VNĐ</b></li>
		<li class="mt-1"><b>Điện thoại: (028) 38682371</b></li>
		<li class="mt-1"><b>Hotline: <span style="color: red;">0917 39 7766</span></b></li>
		<li class="mt-1"><b>Email:</b> <span style="color: blue;">info@switch-router.com</span></li>
		<li class="mt-1"><div id="rateYo" data-toggle="hover" title="{{ $rateavg }}"></div><span style="display: none" id="rating">{{ $rateavg }}</span></li>
		<li class="row mt-4">
			<button class="btn btn-danger col-5 ml-3 " type="">Đăng ký mua</button>
			<button class="addcart btn btn-primary col-5 ml-2" type="" data-id="{{  $sp->id }}">Thêm vào giỏ hàng</button>
		</li>
		<div class="row mt-4" style="font-size: 12px;">
			<div class="col-4"><i class="fa fa-print" aria-hidden="true"></i> In trang này</div>
			<div class="col-4"><i class="fa fa-envelope-o" aria-hidden="true"></i> Gửi cho bạn bè</div>
			<div class="fb-share-button" data-href="127.0.0.1" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ trang này</a></div>
		</div>
	</div>
</div>
<div class="mt-4">	
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Chi tiết sản phẩm</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Bình luận</a>
		</li>
	</ul>
	{{-- {{ var_dump($sp["chitiet"]) }} --}}
	<div class="mt-1">
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
				{{-- {{ html_entity_decode($sp["chitiet"]) }} --}}
				<?php echo html_entity_decode($sp->chitiet); ?>
			</div>
			<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
				@if(Session::has('co_login'))
				<div class="media mt-2" style="box-shadow: 0px 2px 2px rgba(0,0,0,.5);">
					<img src="upload/user/{{ Session::get('co_login')->hinhanh }}" class="mr-3 img-thumbnail" alt="..." style="margin-left: 5px;width: 64px;height:64px ;">
					<div class="media-body">
						<form id="cmmt">
							<h5 class="mt-0">{{ Session::get("co_login")->tentaikhoan }}</h5>
							<div class="row">
								<div class="col-9">
									<div class="ratings">
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</div>
									<br style="clear: left;">
									<input type="hidden" name="txtidsp" id="txtidsp" value="{{  $sp->id }}">
									<input type="hidden" name="txtiduser" id="txtiduser" value="{{ Session::get("co_login")->id }}">
									<input type="hidden" name="txtrate" id="txtrate">
									<div class="form-group">
										<label for="txtbl">Bình luận</label>
										<textarea class="form-control" name="txtbinhluan" id="txtbinhluan"></textarea>
										<small id="thongbao" style="color: red;"></small>
									</div>
								</div>
								<div class="col-3">
									<button type="submit" class="btn btn-primary">Gửi</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				@endif
				<div id="Binhluan" style="height: 500px;">
					@if(count($rates)>0)
					@foreach($rates as $rating)
					<div class="media mt-2" style="border-bottom: solid rgba(0,0,0,.5) .5px;">
							<img src="upload/user/{{ $rating->user->hinhanh }}"class="mr-3 img-thumbnail" alt="..." style="width: 64px;height:64px ;">
						<div class="media-body">
							<h5 class="mt-0">{{ $rating->user->tentaikhoan}}</h5>
							<ul style="list-style: none; padding: 0px;">
							@for($i=1;$i<=$rating->rate;$i++)
								<li style="float: left;"><img src="https://img.icons8.com/cotton/20/000000/starfish--v1.png"/></li>
							@endfor
							</ul>
							<div class="mt-2" style="clear: left;"></div>
							{{ $rating->binhluan }}
							<div><small style="margin-left: 550px; font-size: 10px;">{{ date('d-m-Y',strtotime($rating->created_at)) }}</small></div>
						</div>
					</div>
					@endforeach
					@else
					<div align="center">
						<small class="text-black-50">Sản phẩm này chưa có bình luận nào</small>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>	
</div>
<div class="mt-4">
	@include('user.blocks/sanphamlienquan')
</div>

@endsection
@section('script')
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {	
		$('#list-profile-list').click(function(event) {
			/* Act on the event */
			$a = $("#Binhluan").height();
			if($a>500){
				$("#Binhluan").css('overflow','scroll');
			}
			else{
				$("#Binhluan").css('overflow','auto');
			}
		});
	});
	$(document).ready(function(){		
		const star = document.querySelector(".ratings").children;
		let index;
		console.log(star);
		for(let i=0;i<star.length;i++){
			star[i].addEventListener("mouseover",function(){
				for(let j=0;j<star.length;j++){
					star[j].classList.add("fa-star-o");
					star[j].classList.remove("fa-star");
				}
				for(let j=0;j<=i;j++){
					star[j].classList.remove("fa-star-o");
					star[j].classList.add("fa-star");
				}
			}); 
			star[i].addEventListener("click",function(){
				index = i;
				$("#txtrate").val(i+1);
			});
			star[i].addEventListener("mouseout",function(){
				for(let j=0;j<star.length;j++){
					star[j].classList.add("fa-star-o");
					star[j].classList.remove("fa-star");
				}
				for(let j=0;j<=index;j++){
					star[j].classList.remove("fa-star-o");
					star[j].classList.add("fa-star");
				}
			}); 
		}
	});
	$(window).on('load', function() {
		$a = $("#rating").text();
		$("#rateYo").rateYo({
			rating: $a,
			precision: 2,
			readOnly: true
		});
	});
</script>
<script>
	$('#cmmt').on('submit', function(event) {
		event.preventDefault();
		/* Act on the event */
		$.ajax({
			url: 'user/binhluan',
			type: 'GET',
			dataType: 'json',
			data: $('#cmmt').serialize(),
			success:function(data){
				if(data.success){
					$('#thongbao').text();
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Bình luận thành công',
						showConfirmButton: false,
						timer: 1500
					})
					console.log(data);
					$str ='<div class="media mt-2" style="border-bottom: solid rgba(0,0,0,.5) .5px;">';
					$str +='<img src="upload/user/'+data.hinhanh+'" class="mr-3 img-thumbnail" alt="..." style="width: 64px;height:64px ;">';
					$str +='<div class="media-body">';
					$str +='		<h5 class="mt-0">'+data.ten+'</h5>';
					$str +='<ul style="list-style: none; padding: 0px;">';
					for($i=1;$i<=data.rate;$i++){
					$str +='			<li style="float: left;"><img src="https://img.icons8.com/cotton/20/000000/starfish--v1.png"/></li>';
					}
					$str +='</ul>';
					$str +='<div class="mt-2" style="clear: left;"></div>';
					$str +=data.binhluan;
					$str +='<div><small style="margin-left: 550px; font-size: 10px;">'+data.ngay+'</small></div>';
					$str +='</div>';
					$('#Binhluan').prepend($str);
					$('#txtbinhluan').val('');	
					$("#rating").text(data.avg);				
				}
				else{
					$('#thongbao').text(data.erorrs);
					Swal.fire({
						position: 'top-end',
						icon: 'error',
						title: 'Bình luận thất bại',
						showConfirmButton: false,
						timer: 1500
					})
				}
			},
			error:function(data){
				Swal.fire({
					title: 'Lỗi rồi',
					text: 'Ngắm ảnh rồi thử lại nhé',
					imageUrl: 'https://unsplash.it/400/200',
					imageWidth: 400,
					imageHeight: 200,
					imageAlt: 'Custom image',
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
</script>
@endsection
