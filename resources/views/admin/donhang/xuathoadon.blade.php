<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>xuất đơn hàng</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<div style="width: 800px; margin-left: 20x;">
		<div class="row" style="border-style: solid !important;">
			<div class="col-6" style="margin-left: 5px;" >
				<?php $time = getdate() ?>
				<h4>PHIẾU GIAO HÀNG <br>
					<small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ngày {{ $time["mday"] }}/{{ $time["mon"] }}/{{ $time["year"] }}</small>
				</h4>				
			</div>
			<div class="col-6"></div>
		</div>		
		<div style="min-height: 300px;">
			<div style="width: 200px; height: 400px;border-style: solid !important;  float: left;">
				<div style="margin-left: 5px;">
					<p style="font-weight: bold; ">Shop/ cửa hàng</p>
					<div><i class="fa fa-map-marker" aria-hidden="true"></i> 188/7 Thành Thái, Phường 12, Quận 10, TP.HCM</div><br>
					<div><i class="fa fa-phone" aria-hidden="true"></i> +84 917 39 7766</div> <br>
				</div>
			</div>
			<div style="width: 300px;height: 400px;border-style: solid !important;  float: left;">
				<div style="margin-left: 5px;">
					<p style="font-weight: bold; ">Đơn hàng</p>
					<div>Mã DH: <span  style="font-weight: bold; font-size: 20px;">{{ $donhang->id }}</span></div>
					<div>Thu hộ: <span  style="font-weight: bold;">{{ number_format($donhang->thanhtien) }} đ</span></div>
					<div>Hàng hóa:
						<ul style="list-style: none; padding: 0px;">
							@foreach($donhang->chitietdonhang as $ct)
								<li>+ {{ $ct->sanpham->tensp }} : {{ $ct->soluong }}</li>
							@endforeach
						</ul>
					</div>
					<div>Ghi chú: Cho xem hàng, "giao hàng trong giờ hành chính"</div>
					<div>Ngày tạo: {{ $time["mday"] }}/{{ $time["mon"] }}/{{ $time["year"] }}</div>
				</div>
			</div>
			<div style="height: 400px;border-style: solid !important; ">
				<div style="margin-left: 5px !important;">
					<p style="font-weight: bold; "> &nbsp;Người nhận hàng</p>
					<div> &nbsp;Họ tên:  {{ $donhang->hoten }}</div>
					<div> &nbsp;ĐT: {{ $donhang->sodienthoai }}</div>
					<div> &nbsp;Địa chỉ: {{ $donhang->noigiao }}</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>