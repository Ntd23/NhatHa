@extends('app')
@section('style')
  <style>
    .box-btn {
      height: 110px;
      text-align: center;
      border-radius: 5px;
      box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }
  </style>
@endsection
@section('content')
  <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        <h1 class="page-title">Bảng điều khiển</h1>
      </div>
    </div>

    <div class="page-content">
      <div class="dashboard">
        <div class="container">
				<hr>
				<hr>
          <div class="row">
            @include('user._sidebar')
            <div class="col-md-9 col-lg-10">
              <div class="tab-content">
                <div class="row">
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalOrder }}</div>
                      <div style="font-size: 16px">Đơn hàng đã đặt</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalTodayOrder }}</div>
                      <div style="font-size: 16px">Đơn hàng hôm nay</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">@money($TotalAmount)</div>
                      <div style="font-size: 16px">Tiền đã đặt hàng</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">@money($TotalTodayAmount)</div>
                      <div style="font-size: 16px">Tiền đặt hàng hôm nay</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalPending }}</div>
                      <div style="font-size: 16px">Chờ xác nhận</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalInprogess }}</div>
                      <div style="font-size: 16px">Chờ giao hàng</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalDelivered }}</div>
                      <div style="font-size: 16px">Đã giao hàng</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalCompleted }}</div>
                      <div style="font-size: 16px">Đã hoàn thành</div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-4 border border-dark bg-success">
                    <div class="box-btn">
                      <div style="font-size: 20px; font-weight: bold;" class="text-red">{{ $TotalCancelled }}</div>
                      <div style="font-size: 16px">Đã hủy</div>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End .col-lg-9 -->
          </div><!-- End .row -->
        </div><!-- End .container -->
      </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
  </main>
@endsection
