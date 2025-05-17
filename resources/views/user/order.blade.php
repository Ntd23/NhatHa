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
        <h1 class="page-title">Đơn hàng của tôi</h1>
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
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Số tiền thanh toán</th>
                      <th>Phương thức thanh toán</th>
                      <th>Trạng thái</th>
                      <th>Ngày đặt</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getOrder as $value)
										<tr>
                      <td>{{ $value->order_number }}</td>
                      <td>@money($value->total_amount)</td>
                      <td style="text-transform: capitalize;">{{ $value->payment_method }}</td>
                      <td>
                        @if ($value->status == 0)
                          Chờ xác nhận
                        @elseif ($value->status == 1)
                          Chờ giao hàng
                        @elseif ($value->status == 2)
                          Đã giao hàng
                        @elseif ($value->status == 3)
                          Đã hoàn thành
                        @elseif ($value->status == 4)
                          Đã hủy
                        @endif
                      </td>
                      <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                      <td>
                        <a href="{{route('front.order_detail',$value->id)}}" class="btn btn-info">Chi tiết</a>
                      </td>
											</tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div><!-- End .col-lg-9 -->
          </div><!-- End .row -->
        </div><!-- End .container -->
      </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
  </main>
@endsection
