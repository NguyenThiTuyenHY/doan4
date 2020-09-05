@extends('user.layout.sanpham')
@section('content')
<style type="text/css" media="screen">
	#bodydandmuc .itemdanhmuc:hover{
		box-shadow: 2px 2px 2px 2px rgba(0,0,0,.5);
	}
</style>
<div id="bodydanhmuc">
	<div id="paginatedanhmuc" style="text-align: center;margin-top: 20px;">{{ $sps->links() }}</div>
	@foreach($sps as $sp)
	<div class="row itemdanhmuc" style="width: 100%; border-bottom: solid rgba(0,0,0,.5) .5px; margin-top: 15px; border-radius: 5px;">
		<div class="col-4" style="width: 30%"><a href="user/chitietsanpham/idsp={{ $sp->id }}"><img src="./upload/sanpham/{{ $sp->hinhanh }}" style="width: 100%; padding: 5px;" alt=""></a></div>
		<div class="col-8">
			<h5 style="color: #006699;"><a href="user/chitietsanpham/idsp={{ $sp->id }}">{{ $sp->tensp }}</a></h5>
			<small>{{ $sp->tomtat }}</small><br>
			<a href="user/chitietsanpham/idsp={{ $sp->id }}"><small>Xem thêm >></small></a>
		</div>
	</div>	
	@endforeach
	<div id="paginatedanhmuc" style="text-align: center;margin-top: 20px;">{{ $sps->links() }}</div>
</div>
@endsection
@section('script')
<script type="text/javascript" charset="utf-8">
</script>
@endsection
