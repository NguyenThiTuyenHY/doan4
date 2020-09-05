@extends('user.layout.tintuc')
@section('content')
<style type="text/css" media="screen">
.b-0 {
    bottom: 0;
}
.bg-shadow {
    background: rgba(76, 76, 76, 0);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(179, 171, 171, 0)), color-stop(49%, rgba(48, 48, 48, 0.37)), color-stop(100%, rgba(19, 19, 19, 0.8)));
    background: linear-gradient(to bottom, rgba(179, 171, 171, 0) 0%, rgba(48, 48, 48, 0.71) 49%, rgba(19, 19, 19, 0.8) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313', GradientType=0 );
}
.top-indicator {
    right: 0;
    top: 1rem;
    bottom: inherit;
    left: inherit;
    margin-right: 1rem;
}
.overflow {
    position: relative;
    overflow: hidden;
}
.zoom img {
    transition: all 0.2s linear;
}
.zoom:hover img {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
#listproduct .card {
  border: none;
  height: 200px;
  border-bottom: solid rgba(0,0,0,.5) .5px;
}
#listproduct .card-img {
  border-radius: 0;
}
#listproduct .vgr-cards .card {
  display: flex;
  flex-flow: wrap;
  flex: 100%;
  margin-bottom: 40px;
}
#listproduct .vgr-cards .card:nth-child(even) .card-img-body {
  order: 2;
}
#listproduct  .vgr-cards .card:nth-child(even) .card-body {
  padding-left: 0;
  padding-right: 1.25rem;
}
@media (max-width: 576px) {
#listproduct   .vgr-cards .card {
    display: block;
  }
}
#listproduct  .vgr-cards .card-img-body {
  flex: 1;
  overflow: hidden;
  position: relative;
}
@media (max-width: 576px) {
#listproduct  .vgr-cards .card-img-body {
    width: 100%;
    height: 200px;
    margin-bottom: 20px;
  }
}
#listproduct  .vgr-cards .card-img {
  width: 100%;
  height: auto;
  position: absolute;
  margin-left: 50%;
  transform: translateX(-50%);
}
@media (max-width: 1140px) {
 #listproduct  .vgr-cards .card-img {
    margin: 0;
    transform: none;
    width: 100%;
    height: auto;
  }
}
#listproduct .vgr-cards .card-body {
  flex: 2;
  padding: 0 0 0 1.25rem;
}
@media (max-width: 576px) {
#listproduct .vgr-cards .card-body {
    padding: 0;
  }
}

</style>
<!--Start code-->
{{-- <h3>Tin tức nổi bật</h3> --}}
<!--SECTION START-->
{{-- <section class="row" >
	<!--Start slider news-->
	<div class="col-12 col-md-12 pb-0 pb-md-3 pt-2 pr-md-1">
		<div id="featured" class="carousel slide carousel" data-ride="carousel">
			<!--dots navigate-->
			<ol class="carousel-indicators top-indicator">
				<li data-target="#featured" data-slide-to="0" class="active"></li>
				<li data-target="#featured" data-slide-to="1"></li>
				<li data-target="#featured" data-slide-to="2"></li>
				<li data-target="#featured" data-slide-to="3"></li>
			</ol>

			<!--carousel inner-->
			<div class="carousel-inner">
				@foreach($ttnb1s as $ttnb)
				<!--Item slider-->
				<div class="carousel-item active">
					<div class="card border-0 rounded-0 text-light overflow zoom">
						<div class="position-relative">
							<!--thumbnail img-->
							<div class="ratio_left-cover-1 image-wrapper">
								<a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
									<img class="img-fluid w-100" src="./upload/tintuc/{{ $ttnb->hinhanh }}" alt="Bootstrap news template" style="height:400px;!important;">
								</a>
							</div>
							<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
								<!--title-->
								<a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
									<h4 class="h3 post-title text-white my-1">Bootstrap 4 template news portal magazine perfect for news site</h4>
								</a>
								<!-- meta title -->
							</div>
						</div>
					</div>
				</div>
				@endforeach
				@foreach($ttnbs as $ttnb)
				<!--Item slider-->
				<div class="carousel-item">
					<div class="card border-0 rounded-0 text-light overflow zoom">
						<div class="position-relative">
							<!--thumbnail img-->
							<div class="ratio_left-cover-1 image-wrapper">
								<a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
									<img class="img-fluid w-100" src="./upload/tintuc/{{ $ttnb->hinhanh }}" alt="Bootstrap news template" style="height:400px;!important;">
								</a>
							</div>
							<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
								<!--title-->
								<a href="https://bootstrap.news/bootstrap-4-template-news-portal-magazine/">
									<h4 class="h3 post-title text-white my-1">Bootstrap 4 template news portal magazine perfect for news site</h4>
								</a>
								<!-- meta title -->
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!--end carousel inner-->
		</div>

		<!--navigation-->
		<a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#featured" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!--End slider news-->
</section> --}}
<!--END SECTION-->
<!--end code-->
{{-- 	<h3>Danh sách tin tức</h3> --}}
	<div style="margin-top: 20px;">
		<div id="listproduct" class="container top10">
			<div class="row">
				<div>
					<div class="card-group vgr-cards">
						@foreach($tt as $t)
						<div class="card">
							<div class="card-img-body">
								<img class="card-img" src="./upload/tintuc/{{ $t->hinhanh }}" alt="Card image cap">
							</div>
							<div class="card-body">

								<h4 class="card-title" style="margin-left: 10px;">{{ $t->tieude }}</h4>
								@if(strlen($t->tomtat) >= 150)
								<?php $str=substr($t->tomtat,0, 150) ?>
								<p class="card-text" style="margin-left: 10px;">{{ $str." ..." }}</p>
								@else
								<p class="card-text" style="margin-left: 10px;">{{ $t->tomtat }}</p>
								@endif
								<a href="user/phuongtien/lpt={{ $t->loaitheloai->id }}/idpt={{ $t->id }}" class="btn btn-outline-primary" style="margin-left: 10px;">Xem chi tiết >></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="paginatetintuc" style="text-align: center;margin-top: 20px;">{{ $tt->links() }}</div>
@endsection
@section('script')
<script>
	$(document).ready(function(){
      $(".linkfeat").hover(
        function () {
            $(".textfeat").show(500);
        },
        function () {
            $(".textfeat").hide(500);
        }
    );
});
</script>
@endsection