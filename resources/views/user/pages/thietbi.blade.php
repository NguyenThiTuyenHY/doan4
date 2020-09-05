@extends('user.layout.index')
@section('page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.1/jquery.rateyo.min.js"></script> --}}
<style type="text/css" media="screen">
	.main-section{
	margin-top:150px;
	background-color: white;
	padding:20px 0px 50px 0px;
}
.main-section .rateyo{
	position: relative;
	left:50%;
	transform:translateX(-50%);
}
.main-section h1{
	color: black;
	font-size: 25px;
	margin:20px 0px 50px 0px;
}
</style>
<div class="row">
	<div class="offset-lg-4 col-lg-4 col-sm-4 col-12 main-section text-center">
		<h1>RateYo - Scratchpad</h1>
		<div class="rateyo"></div>
	</div>
</div>
@endsection
@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script> --}}
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
@endsection