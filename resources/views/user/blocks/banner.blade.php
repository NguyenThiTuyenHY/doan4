<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
	</ol>
	<div class="carousel-inner">
		{{-- <div class="carousel-item active">
			<img src="./upload/slider/slidershow1.jpg" class="d-block w-100" alt="..." style="height:450px;">
		</div> --}}
		{{-- <div class="carousel-item">
			<img src="./upload/slider/slideshow2.jpg" class="d-block w-100" alt="..." style="height:450px;">
		</div>
		<div class="carousel-item">
			<img src="./upload/slider/slidershow3.png" class="d-block w-100" alt="..." style="height:450px;">
		</div>
		<div class="carousel-item">
			<img src="./upload/slider/slidershow4.jpg" class="d-block w-100" alt="..." style="height:450px;">
		</div>
		<div class="carousel-item">
			<img src="./upload/slider/slidershow5.jpg" class="d-block w-100" alt="..." style="height:450px;">
		</div> --}}
		@foreach($stt as $st)
		<div class="carousel-item active">
			<img src="./upload/slider/{{ $st->hinhanh }}" class="d-block w-100" alt="..." style="height:450px;">
		</div>
		@endforeach
		@foreach($sliders as $slider)
		<div class="carousel-item">
			<img src="./upload/slider/{{ $slider->hinhanh }}" class="d-block w-100" alt="..." style="height:450px;">
		</div>
		@endforeach
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>