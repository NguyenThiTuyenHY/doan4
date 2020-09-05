
<div style="width: 600px; border: solid rgba(0,0,0,.5) .5px;">
	<div style="width: 94%; margin-left: 3%;">
		<h3 class="text-uppercase" style="text-align: center;">ĐƠN HÀNG</h3>
		<?php $a = getdate(); ?>
		<div style="text-align: center;"><small class="text-uppercase text-black-50" >Ngày {{ $a["mday"] }} tháng {{ $a["mon"] }} năm {{ $a["year"] }}</small></div>
		<div><b>Kính gửi:</b> Qúy khách hàng {{ $data["name"] }}</div>
		<div>Theo nhu cầu đặt hàng. Chúng tôi xin gửi đến Qúy khách hàng bảng đặt hàng các sản phẩm như sau: </div>
		<table>
			<caption>Bảng sản phẩm</caption>
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Giá</th>
					<th>Thành tiền</th>
				</tr>
			</thead>
			<tbody>
				<?php $t=1; ?>
				@foreach($data["orderdetail"] as $order)
				<tr>
					<td style="text-align: center;">{{ $t++ }}</td>
					<td>{{ $order->name }}</td>
					<td style="text-align: center;">{{ $order->quantity}}</td>
					<td>{{ number_format($order->price) }}</td>
					<td>{{ number_format($order->price * $order->quantity) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
			<div class="col-8">Đơn hàng chưa bao gồm thuế (VAT: 10%)</div>
			<div class="col-4">Tổng cộng: {{ number_format($data["subtotal"] )}}</div>
		</div>
		<div class="row">
			<div class="col-8"></div>
			<div class="col-4">
				<div style="text-align: center;">Đơn vị bán hàng</div>
				<div style="text-align: center;">Website bán thiết bị mạng LAN sao Thiên Vương</div>
			</div>
		</div>
	</div>
</div>
