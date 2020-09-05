<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	{{-- <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta property="og:title" content="{{$meta_title}}" />
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author" content=""> --}}
	<title>Trang chủ- Sao Thiên Vương, Phân phối thiết bị mạng</title>
	<base href="{{ asset('') }}">
	<link rel="shortcut icon" type="image/png" href="upload/system/shorticon.png"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	<link rel="stylesheet" href="admin/dist/sweetalert2.min.css">
	{{-- <link  rel="canonical" href="{{$url_canonical}}" /> --}}
</head>
<body class="container-fuil" style="overflow-x: hidden;">

	<div>
		<!-- PHAN DAU -->
		@include('user.layout.header')
		<!-- PHAN THAN HOME	 -->

		<div style="width: 70%; margin: auto;" id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			@yield('page')
		</div>		
	</div>

	<!-- PHAN FOOTER -->

	@include('user.layout.footer')
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
	<script src="admin/dist/sweetalert2.min.js"></script>
	@yield('script')
	@yield('script1')
	<script>
		$(".addcart").click(function(event) {
			/* Act on the event */
			$id = $(this).data('id');
			// $.ajax({
			// 	url: 'user/giohang/themsanpham',
			// 	type: 'GET',
			// 	dataType: 'Json',
			// 	data: {id:$a},
			// 	success:function(data){
			// 		if(data.success){
			// 			Swal.fire({
			// 				position: 'top-end',
			// 				icon: 'success',
			// 				title: 'Thêm giỏ hàng thành công',
			// 				showConfirmButton: false,
			// 				timer: 1500
			// 			});
			// 		}
			// 		else{
			// 			Swal.fire({
			// 				position: 'top-end',
			// 				icon: 'erorr',
			// 				title: 'Thêm giỏ hàng thất bại',
			// 				showConfirmButton: false,
			// 				timer: 1500
			// 			});
			// 		}
			// 	}
			// 	error:function()
			// 		Swal.fire({
			// 			position: 'top-end',
			// 			icon: 'erorr',
			// 			title: 'Thêm giỏ hàng thất bại',
			// 			showConfirmButton: false,
			// 			timer: 1500
			// 		});
			// 	}
			// })
			// .done(function() {
			// 	console.log("success");
			// })
			// .fail(function() {
			// 	console.log("error");
			// })
			// .always(function() {
			// 	console.log("complete");
			// });
			$.get('user/giohang/themsanpham/'+$id,function(data){
				if(data.success){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Thêm giỏ hàng thành công',
						showConfirmButton: false,
						timer: 1500
					});
				}
				else{
					Swal.fire({
						position: 'top-end',
						icon: 'erorr',
						title: 'Thêm giỏ hàng thất bại',
						showConfirmButton: false,
						timer: 1500
					});
				}
			});			
		});
	</script>
</body>
</html>