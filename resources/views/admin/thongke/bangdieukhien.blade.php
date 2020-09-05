@extends('admin.layout.index')
@section('noidung')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sản phẩm</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($sps) }}</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-product-hunt fa-2x text-gray-300" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh thu(năm)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhthunam) }} đ</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  {{-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng(Năm)</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

   <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn hàng(năm)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sohoadontheonam }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Khách hàng</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($uss)-1 }}</div>
          </div>
          <div class="col-auto">
            <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh thu({{ number_format('10000000') }} đ)</h6>
      </div>
      <div class="card-body">
        @foreach($dsdoanhthu as $key=>$ds)
        <h4 class="small font-weight-bold">Tháng {{ $key+1 }}<span class="float-right">{{ number_format($ds) }}</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($ds/10000000)*100 }}%" aria-valuenow="{{ $ds }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Color System -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Top sản phẩm được ưa thích (<img src="https://img.icons8.com/plasticine/20/000000/hand-drawn-star.png"/> > 3)</h6>
      </div>
      <div class="card-body">
        @if(count($dsut)>0)
        <table class="table" id="TableUT">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Rate</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dsut as $ds)
              <tr>
                <td>{{ $ds["sput"]->tensp }}</td>
                <td class="text-center"><img src="./upload/sanpham/{{ $ds["sput"]->hinhanh }}" style="width: 50px;" alt=""></td>
                <td class="text-center">{{ $ds["rate"] }} <img src="https://img.icons8.com/plasticine/20/000000/hand-drawn-star.png"/></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-primary text-center">Không có sản phẩm nào</div>
        @endif
      </div>
    </div>
    
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm có số đánh giá thấp</h6>
      </div>
      <div class="card-body">
        @if(count($dssaothaprate)>0)
        <table class="table" id="TableTH">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Rate</th>
                <th>Bình luận</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dssaothaprate as $ds)
              <tr>
                <td>{{ $ds->sanpham->tensp }}</td>
                <td class="text-center"><img src="./upload/sanpham/{{ $ds->sanpham->hinhanh }}" style="width: 50px;" alt=""></td>
                <td class="text-center">{{ $ds->rate }} <img src="https://img.icons8.com/plasticine/20/000000/hand-drawn-star.png"/></td>
                <td>{{ $ds->binhluan }}</td>
                <td>
                  @if($ds->trangthai == 1)
                  <button type="button" id="btn_{{ $ds->id }}" data-id="{{ $ds->id }}" data-tt="1" class="chuyentt btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button>
                  @else
                  <button type="button" id="btn_{{ $ds->id }}" data-id="{{ $ds->id }}" data-tt="2" class="chuyentt btn btn-danger"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
        <div class="alert alert-primary text-center">Không có sản phẩm nào</div>
        @endif
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nhà cung cấp</h6>
      </div>
      <div class="card-body">
        <table class="table" id="dataTable">
            <thead>
              <tr>
                <th>Tên nhà cung cấp</th>
                <th>Số lần lấy hàng</th>
                <th>Số sản phẩm</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dsncc as $ds)
              <tr>
                <td>{{ $ds["ncc"] }}</td>
                <td class="text-center">{{ $ds["solan"] }}</td>
                <td class="text-center">{{ $ds["sosp"] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>

    <!-- Color System -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thông kế các mục đang quản lý</h6>
      </div>
      <div class="card-body">
        <div>
          <h6>Danh mục: <span>{{ count($dms) }}</span></h6>
        </div>
        <div>
          <h6>Loại danh mục: <span>{{ count($ldms) }}</span></h6>
        </div>
        <div>
          <h6>Phân loại: <span>{{ count($pls) }}</span></h6>
        </div>
        <div>
          <h6>Sản phẩm: <span>{{ count($sps) }}</span></h6>
        </div>
        <div>
          <h6>Thể loại: <span>{{ count($tls) }}</span></h6>
        </div>
        <div>
          <h6>Loại thể loại: <span>{{ count($ltls) }}</span></h6>
        </div>
        <div>
          <h6>Phương tiện: <span>{{ count($tts) }}</span></h6>
        </div>
        <div>
          <h6>Khách hàng: <span>{{ count($uss)-1 }}</span></h6>
        </div>
        <div>
          <h6>Đơn hàng chưa xác nhận: <span>{{ $donhangchuaxacnhan }}</span></h6>
        </div>
        <div>
          <h6>Đơn hàng xác nhận: <span>{{ $donhangxacnhan }}</span></h6>
        </div>
        <div>
          <h6>Đơn hàng đang giao: <span>{{ $donhangdanggiao}}</span></h6>
        </div>
        <div>
          <h6>Đơn hàng đã giao: <span>{{ $donhanghoanthanh }}</span></h6>
        </div>
        <div>
          <h6>Đơn hàng đã hủy: <span>{{ $donhanghuy }}</span></h6>
        </div>
        <div>
          <h6>Hóa đơn nhập: <span>{{ $sohoadon }}</span></h6>
        </div>
        <div>
          <h6>Nhà cung cấp: <span>{{ count($nhacungcaps) }}</span></h6>
        </div>
         <div>
          <h6>Rating&Bình luận: <span>{{ count($rates) }}</span></h6>
        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng(100 sản phẩm)</h6>
      </div>
      <div class="card-body">
        @foreach($dssdh as $key=>$ds)
        <h4 class="small font-weight-bold">Tháng {{ $key+1 }}<span class="float-right">{{ $ds }}</span></h4>
        <div class="progress mb-4">
          <div class="progress-bar bg-success" role="progressbar" style="width: {{ $ds }}%" aria-valuenow="{{ $ds }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phầm sắp hết</h6>
      </div>
      <div class="card-body">
        <div>
          <table class="table" id="TableSaphet">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($spsh as $sp)
              <tr>
                <td>{{ $sp->tensp }}</td>
                <td class="text-center"><img src="./upload/sanpham/{{ $sp->hinhanh }}" style="width: 50px;" alt=""></td>
                <td class="text-center">{{ $sp->soluong }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm hết</h6>
      </div>
      <div class="card-body">
        <div>
          <table class="table" id="Tablehet">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Loại sản phẩm</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sph as $sp)
              <tr>
                <td>{{ $sp->tensp }}</td>
                <td class="text-center"><img src="./upload/sanpham/{{ $sp->hinhanh }}" style="width: 50px;" alt=""></td>
                <td class="text-center">{{$sp->loaidanhmuc->tenldm}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sô lần hủy đơn</h6>
      </div>
      <div class="card-body">
        @if(count($dshuy)>0)
        <table class="table" id="datahuydon">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên tài khoản</th>
              <th>Số lần hủy</th>
              <th>Kích hoạt / khóa</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dshuy as $ds)
            <tr>
              <td>{{ $ds["id"] }}</td>
              <td class="text-center">{{ $ds["name"] }}</td>
              <td class="text-center">{{ $ds["solanhuy"] }}</td>
              <td class="text-center">
                @if($ds["trangthai"]==1)
                <button style="button" id="{{ $ds['id'] }}_7" class="btn badge badge-info btnkichhoat" data-tt="1" data-id="{{ $ds['id'] }}">
                  <i class="fa fa-unlock fa-2x" aria-hidden="true"></i>
                </button> 

                @else
                <button style="button" id="{{$ds['id']}}_7" class="btn badge badge-danger btnkichhoat" data-tt="2" data-id="{{ $ds['id'] }}">
                  <i class="fa fa-lock fa-2x" aria-hidden="true"></i>
                </button> 

                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-primary">Chưa có khách hàng nào</div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
    $(document).ready( function () {
      $('#Tablehet').DataTable();
    });
    $(document).ready( function () {
      $('#TableSaphet').DataTable();
    });
    $(document).ready( function () {
      $('#TableUT').DataTable();
    });   
    $(document).ready( function () {
      $('#datahuydon').DataTable();
    });
    $(document).ready( function () {
      $('#TableTH').DataTable();
    });
    $(document).ready(function() {
      $("#TableTH").on('click', '.chuyentt', function(event) {
        /* Act on the event */
        $id = $(this).data('id');
        $tt = $(this).attr('data-tt');
        $.get('admin/rate/chuyentt/'+$id+'/'+$tt,function(data){
          if(data.success){
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Chuyển trang thái thành công',
              showConfirmButton: false,
              timer: 1500
            });
            if(data.tt == 1){
              $("#btn_"+ $id).attr('data-tt',1);
              $("#btn_"+ $id).attr('class', 'chuyentt btn btn-success');
              $("#btn_"+ $id).html('<i class="fa fa-eye" aria-hidden="true"></i>');
            }
            else{
              $("#btn_"+ $id).attr('data-tt',2);
              $("#btn_"+ $id).attr('class', 'chuyentt btn btn-danger');
              $("#btn_"+ $id).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
            }
          }
          else{
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Chuyển trạng thái thất bại',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      });
      $("#datahuydon").on('click', '.btnkichhoat', function(event) {
        event.preventDefault();
        /* Act on the event */
        $b = $(this).data('id');
        $a = $("#"+$b+"_7").attr('data-tt');  
        $.get("admin/khachhang/trangthai/"+$b+"/"+$a,function(data){
          if(data){
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Cập nhật trạng thái khách hàng thành công',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true
            });
            if($a==1){
              $("#"+$b+"_7").attr('data-tt',2);
              $("#"+$b+"_7").attr('class','btn badge badge-danger btnkichhoat');
              $("#"+$b+"_7").html('<i class="fa fa-lock fa-2x" aria-hidden="true"></i>');
            }
            if($a==2){
              $("#"+$b+"_7").attr('data-tt',1);
              $("#"+$b+"_7").attr('class','btn badge badge-info btnkichhoat');
              $("#"+$b+"_7").html('<i class="fa fa-unlock fa-2x" aria-hidden="true"></i>');
            }
          }
          else{
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Cập nhật trạng thái của khách hàng thất bại',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true
            });
          }
        });   
      });
    });
  </script>
@endsection