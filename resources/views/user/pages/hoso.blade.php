@extends('user.layout.index')
@section('page')
<h1 class="h3 mb-2 text-gray-800">Hồ sơ của bạn</h1>
<p class="mb-4">Thông tin liên quan đến người quản trị</p>

<!-- DataTales Example -->
{{-- {{ $us['id'] }} --}}
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Thông tin cá nhân</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-4 text-center">
				<img src="upload/user/{{$us ->hinhanh}}" class="rounded img-thumbnail" alt="...">
			</div>
			<div class="col-4">
				<?php
					$a = explode('-', $us->ngaysinh);
					$b = getdate();; 
				?>
				<p>Chào bạn {{ $us->name }} <img src="upload/system/tenor.gif" alt="" style="width: 40px;">.</p>
				<p>Bạn đã {{ $b["year"] - $a[0] }} mùa xuân xanh.</p>
				<p>
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					width="32" height="32"
					viewBox="0 0 172 172"
					style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#cccccc"><path d="M21.5,21.5v129h129v-129zM32.25,32.25h107.5v107.5h-11.08594c-1.84766,-14.5293 -11.04394,-26.81201 -23.68359,-33.08984c8.02051,-5.87891 13.26953,-15.36914 13.26953,-26.03516c0,-17.7417 -14.5083,-32.25 -32.25,-32.25c-17.7417,0 -32.25,14.5083 -32.25,32.25c0,10.66602 5.24903,20.15625 13.26953,26.03516c-12.63965,6.27783 -21.83594,18.56055 -23.68359,33.08984h-11.08594zM86,59.125c11.94678,0 21.5,9.55322 21.5,21.5c0,11.94678 -9.55322,21.5 -21.5,21.5c-11.94678,0 -21.5,-9.55322 -21.5,-21.5c0,-11.94678 9.55322,-21.5 21.5,-21.5zM86,112.875c16.04102,0 29.20557,11.56885 31.74609,26.875h-63.49219c2.54053,-15.30615 15.70508,-26.875 31.74609,-26.875z"></path></g></g></svg> {{ $us->tentaikhoan }}
				</p>
				<p><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					width="32" height="32"
					viewBox="0 0 172 172"
					style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#cccccc"><path d="M118.25,16.125c-17.7417,0 -32.25,14.5083 -32.25,32.25c0,5.33301 2.05762,10.77099 4.70313,16.79688c2.64551,6.02588 5.98389,12.40869 9.40625,18.30859c6.84473,11.79981 13.77344,21.66797 13.77344,21.66797l4.36719,6.38281l4.36719,-6.38281c0,0 6.92871,-9.86816 13.77344,-21.66797c3.42236,-5.8999 6.76074,-12.28271 9.40625,-18.30859c2.64551,-6.02588 4.70313,-11.46386 4.70313,-16.79687c0,-17.7417 -14.5083,-32.25 -32.25,-32.25zM64.33203,26.53906l-42.83203,18.30859v103.13281l43.16797,-18.64453l43,16.125l42.83203,-18.30859v-46.86328c-3.42236,6.57178 -7.22266,12.8706 -10.75,18.47656v21.33203l-26.875,11.42188v-8.73437l-7.89453,-11.42187c-0.83984,-1.21777 -1.82666,-2.66651 -2.85547,-4.19922v24.85938l-32.25,-12.09375v-79.95312l5.87891,2.18359c0.5249,-3.63232 1.46973,-7.13867 2.85547,-10.41406zM118.25,26.875c11.92578,0 21.5,9.57422 21.5,21.5c0,2.07861 -1.30176,6.9917 -3.69531,12.42969c-2.39355,5.43799 -5.77393,11.61084 -9.07031,17.30078c-4.38818,7.55859 -6.27783,10.24609 -8.73437,13.94141c-2.45654,-3.69531 -4.34619,-6.38281 -8.73437,-13.94141c-3.29639,-5.68994 -6.67676,-11.86279 -9.07031,-17.30078c-2.39355,-5.43799 -3.69531,-10.35107 -3.69531,-12.42969c0,-11.92578 9.57422,-21.5 21.5,-21.5zM59.125,40.3125v79.78516l-26.875,11.42188v-79.61719zM118.25,40.3125c-4.45117,0 -8.0625,3.61133 -8.0625,8.0625c0,4.45117 3.61133,8.0625 8.0625,8.0625c4.45117,0 8.0625,-3.61133 8.0625,-8.0625c0,-4.45117 -3.61133,-8.0625 -8.0625,-8.0625z"></path></g></g></svg> {{ $us->diachi }}
				</p>
				<p><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					width="32" height="32"
					viewBox="0 0 172 172"
					style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#cccccc"><path d="M143.33333,136.16667h-114.66667v-86l57.33333,35.83333l57.33333,-35.83333z" opacity="0.3"></path><path d="M143.33333,28.66667h-114.66667c-7.91917,0 -14.33333,6.41417 -14.33333,14.33333v86c0,7.91917 6.41417,14.33333 14.33333,14.33333h114.66667c7.91917,0 14.33333,-6.41417 14.33333,-14.33333v-86c0,-7.91917 -6.41417,-14.33333 -14.33333,-14.33333zM136.16667,129h-100.33333v-86h100.33333z"></path><path d="M21.5,52.86133l64.5,40.30533l64.5,-40.30533v-21.5l-64.5,40.30533l-64.5,-40.30533z"></path></g></g></svg> {{ $us->email }}
				</p>
				<p><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
					width="32" height="32"
					viewBox="0 0 172 172"
					style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#cccccc"><path d="M53.75,16.125c-5.83691,0 -10.75,4.91309 -10.75,10.75v118.92188c0,5.58496 4.49317,10.07813 10.07813,10.07813h65.84375c5.58496,0 10.07813,-4.49316 10.07813,-10.07812v-118.92187c0,-5.83691 -4.91308,-10.75 -10.75,-10.75zM53.75,26.875h64.5v69.875h-64.5zM86,102.125c2.96045,0 5.375,2.41455 5.375,5.375c0,2.96045 -2.41455,5.375 -5.375,5.375c-2.96045,0 -5.375,-2.41455 -5.375,-5.375c0,-2.96045 2.41455,-5.375 5.375,-5.375zM62.48438,118.25h7.39063v10.75h-16.125v-2.01562c0,-4.8501 3.88428,-8.73437 8.73438,-8.73437zM75.25,118.25h21.5v10.75h-21.5zM102.125,118.25h7.39063c4.8501,0 8.73438,3.88428 8.73438,8.73438v2.01563h-16.125zM53.75,134.375h16.125v10.75h-7.39062c-4.8501,0 -8.73437,-3.88428 -8.73437,-8.73437zM75.25,134.375h21.5v10.75h-21.5zM102.125,134.375h16.125v2.01563c0,4.8501 -3.88428,8.73438 -8.73437,8.73438h-7.39062z"></path></g></g></svg> {{ $us->sdt }}
				</p>
				<p style="text-align: center;">
					<a href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn-primary"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
				</p>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</div>
@endsection