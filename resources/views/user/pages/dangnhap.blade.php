<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
	<base href="{{ asset('') }}">
	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="./css/style.css" media="screen" type="text/css" />
	<link rel="shortcut icon" type="image/png" href="upload/system/shorticon.png"/>
	<link rel="stylesheet" href="admin/dist/sweetalert2.min.css">
</head>

<body>
  	<form id="form">
  		@csrf
  		<div class="wrap">
  			<div id="loi" style=""></div>
			<div class="avatar">
      			<img src="https://img.icons8.com/bubbles/60/000000/user.png"/>
			</div>
			<input type="text" placeholder="Tài khoản" name="txtemail" id="txttk">
			<div class="bar">
			</div>
			<input type="password" placeholder="Mật khẩu" name="txtpass" id="txtmk">
			<button type="submit">Đăng nhập</button>
		</div>
  	</form>
  	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="./js/index.js"></script>
	<script src="admin/dist/sweetalert2.min.js"></script>
	<script>
		$('#form').on('submit', function(event) {
			event.preventDefault();
			/* Act on the event */
			$a = $("#txttk").val();
			$b = $("#txtmk").val();
			if($a.length>0&&$b.length>0){
				$("#loi").attr('style','');
				$("#loi").text('');
				$.ajax({
					url: '{{ route('getdangnhap') }}',
					method: 'get',
					datatype: 'json',
					// data: $('#form').serialize(),
					data: {txtemail:$a,txtpass:$b},
					success:function(data){
						if(data.success){
							let timerInterval
							Swal.fire({
								title: 'Đăng nhập thành công',
								html: 'Bạn chờ chúng tôi sau <b></b> giây trang tự động chuyển về.',
								timer: 3600,
								timerProgressBar: true,
								onBeforeOpen: () => {
									Swal.showLoading()
									timerInterval = setInterval(() => {
										const content = Swal.getContent()
										if (content) {
											const b = content.querySelector('b')
											if (b) {
												b.textContent = Swal.getTimerLeft()
											}
										}
									}, 100)
								},
								onClose: () => {
									clearInterval(timerInterval)
								}
							}).then((result) => {
								/* Read more about handling dismissals below */
								if (result.dismiss === Swal.DismissReason.timer) {
									window.location = '{{$url}}';
								}
							});
						}
						else{
						// Swal.fire({
						// 	title: 'Bạn đăng nhập thất bại rồi hí hí',
						// 	text: 'Vui lòng ngắm ảnh và thử lại lần nữa nhé!',
						// 	imageUrl: 'https://unsplash.it/400/200',
						// 	imageWidth: 400,
						// 	imageHeight: 200,
						// 	imageAlt: 'Thân ái',
						// });
						Swal.fire({
							title: data.thongbao,
							text: 'Vui lòng ngắm ảnh và thử lại lần nữa nhé!',
							imageUrl: 'https://unsplash.it/400/200',
							imageWidth: 400,
							imageHeight: 200,
							imageAlt: 'Thân ái',
						});
						}
					},
					error:function(data){
						Swal.fire({
						title: data.thongbao,
						text: 'Vui lòng ngắm ảnh và thử lại lần nữa nhé!',
						imageUrl: 'https://unsplash.it/400/200',
						imageWidth: 400,
						imageHeight: 200,
						imageAlt: 'Thân ái',
						});
					}
				});	
			}
			else{
				$("#loi").attr('style','width: 50%,margin-left: 25%;background-color: #FF0000; color: #fff; padding: 10px;');
				$("#loi").text('Không được để trống');
			}
		});
	</script>
</body>

</html>