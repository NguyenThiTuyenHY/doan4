@extends('admin.layout.index')
@section('noidung')
<h1 class="h3 mb-2 text-gray-800">Thể loại</h1>
<p class="mb-4">Thể loại trong cửa hàng</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 row">
		<h6 class="m-0 font-weight-bold text-primary col-lg-9">Danh sách thể loại</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên thể loại</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Tên SP</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($tls as $tl)
					<tr>
						<td>{{ $tl->id }}</td>
						<td>{{ $tl->tentl }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection