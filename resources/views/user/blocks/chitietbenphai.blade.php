<style type="text/css" media="screen">
	.nestedsidemenu {
		font: bold 14px 'Bitter', sans-serif;
		position: relative;
		width: 215px;
	}
	.nestedsidemenu ul {
		z-index: 100;
		margin: 0;
		padding: 0;
		position: relative;
		list-style: none;
	}
	.nestedsidemenu ul li {
		position: relative;
	}

	.nestedsidemenu ul li a, .nestedsidemenu ul li span {
		display: block;
		position: relative;
		/* background of menu items (default state) */
		background: #008c9e;
		color: white;
		padding: 14px 10px;
		color: #2d2b2b;
		text-decoration: none;
	}

	.nestedsidemenu ul li a:link, .nestedsidemenu ul li a:visited {
		color: white;
	}

	.nestedsidemenu ul li ul {
		display:none;
		opacity: 0;
		width: 215px;
		/* visibility: hidden; */
		box-shadow: 2px 2px 5px gray;
		-webkit-transition: opacity .3s, visibility 0s .3s, left 0s .3s;
		transition: opacity .3s, visibility 0s .3s, left 0s .3s;
	}
	.nestedsidemenu ul li:hover > ul {
		display:block;
		opacity: 1;
		-webkit-transition: opacity .5s;
		transition: opacity .5s;
	}
	.nestedsidemenu ul ul li:hover > a {
		background: #33ccff;
	}
</style>
<h4 class="text-black-50">Danh mục</h4>
<div class="nestedsidemenu">
<ul>
@foreach($danhmuc as $dm)
<li><a href="javascript:vold(0)">{{ $dm->tendm }}&nbsp;&nbsp;&nbsp;&nbsp;@if(count($dm->loaidanhmuc)>0)<i class="fa fa-caret-down" aria-hidden="true"></i>@endif</a>
	<ul>
		@foreach($loaidanhmuc as $ldm)
		@if($ldm->iddm == $dm->id)
		<li style="background-color: #3399cc"><a href="javascript:vold(0)"> + {{ $ldm->tenldm }}&nbsp; @if(count($ldm->phanloai)>0)<i class="fa fa-caret-down" aria-hidden="true"></i>@endif</a>
			<ul>
				@foreach($phanloai as $pl)
				@if($pl->idl == $ldm->id)
				<li style="background-color: #6699ff"><a href="user/phanloai/idpl={{ $pl->id }}"> - {{ $pl->tenpl }}</a></li>
				@endif
				@endforeach
			</ul>
		</li>
		@endif
		@endforeach
	</ul>
</li>
@endforeach
</ul>
<br style="clear: left" />
</div>
