{{-- <style type="text/css" media="screen">
	.spmoi:hover a{
		box-shadow: 2px 2px 2px rgba(0,0,0,.5);
	}
	.spmoi{
		position: relative;
	}
</style> --}}
<style>
    .addcart:hover{
        cursor: pointer;
    }
</style>
<div class="container">	  
    <div class="row">
    	@foreach($spms as $spm)
        <div class="col-md-3 col-sm-6">
            <div class="product-grid2">
                <div class="product-image2">
                    <a href="user/chitietsanpham/idsp={{ $spm->id }}">
                        <img class="pic-1" src="upload/sanpham/{{ $spm->hinhanh }}">
                        <img class="pic-2" src="upload/sanpham/{{ $spm->hinhanh }}">
                    </a>
                    <ul class="social">
                        <li><a href="user/chitietsanpham/idsp={{ $spm->id }}" data-tip="Chi tiết"><i class="fa fa-eye"></i></a></li>
                        <li><a class="addcart" data-tip="Thêm giỏ hàng" data-id="{{ $spm->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <a class="addcart add-to-cart" data-id="{{ $spm->id }}">Thêm vào giỏ hàng</a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="user/chitietsanpham/idsp={{ $spm->id }}">{{ $spm->tensp }}</a></h3>
                    <span class="price" style="color: red; font-weight: bold;">{{ number_format($spm->gia) }} VNĐ</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- @foreach($spms as $spm)
<div class="spmoi">	
	<a href="user/chitietsanpham/idsp={{ $spm->id }}" style="width: 19%; height: 200px; float: left; background-color: #000;margin-left: 5px;" title="{{ $spm->tensp }}"> 
		<img src="upload/sanpham/{{ $spm->hinhanh }}" style="width:100%; height:200px;" alt="">
	</a>
	<div></div>
</div>
@endforeach --}}