@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-12">
          <h4 class="page-title">Đang có {{ $getRecord->total() }} đơn hàng</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form method="get">
            {{ csrf_field() }}
            <div class="card-box row">
              <div class="form-group col-2">
                <label class="col-form-label">Số đơn hàng</label>
                <input class="form-control" type="text" name="order_number" value="{{ Request::get('order_number') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Công ty</label>
                <input class="form-control" type="text" name="company_name" value="{{ Request::get('company_name') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Tên</label>
                <input class="form-control" type="text" name="first_name" value="{{ Request::get('first_name') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Họ</label>
                <input class="form-control" type="text" name="last_name" value="{{ Request::get('last_name') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Quốc gia</label>
                <input class="form-control" type="text" name="country" value="{{ Request::get('country') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Quận/Huyện</label>
                <input class="form-control" type="text" name="district" value="{{ Request::get('district') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Thành phố</label>
                <input class="form-control" type="text" name="city" value="{{ Request::get('city') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Mã bưu điện</label>
                <input class="form-control" type="text" name="postcode" value="{{ Request::get('postcode') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Điện thoại</label>
                <input class="form-control" type="text" name="phone" value="{{ Request::get('phone') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Email</label>
                <input class="form-control" type="text" name="email" value="{{ Request::get('email') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Từ ngày</label>
                <input class="form-control" type="date" name="from_date" value="{{ Request::get('from_date') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Đến ngày</label>
                <input class="form-control" type="date" name="to_date" value="{{ Request::get('to_date') }}">
              </div>
              <div class="form-group col-6">
                <div class="row"><button class="btn btn-primary ml-3">Tìm kiếm</button>
                  <a href="{{ route('admin.order.index') }}" class="btn btn-dark mx-3">Làm mới</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Số đơn hàng</th>
                  <th style="min-width: 150px;">Tên người dùng</th>
                  <th style="min-width: 130px;">Công ty</th>
                  <th style="min-width: 130px;">Quốc gia</th>
                  <th style="min-width: 130px;">Địa chỉ</th>
                  <th style="min-width: 130px;">Thành phố</th>
                  <th style="min-width: 130px;">Quận/Huyện</th>
                  <th style="min-width: 130px;">Mã bưu điện</th>
                  <th style="min-width: 130px;">Điện thoại</th>
                  <th style="min-width: 130px;">Email</th>
                  <th>Mã giảm giá</th>
                  <th style="min-width: 130px;">Đã giảm</th>
                  <th style="min-width: 130px;">Phí giao hàng</th>
                  <th style="min-width: 130px;">Thành tiền</th>
                  <th style="min-width: 130px;">Thanh toán</th>
                  <th>Trạng thái</th>
                  <th style="min-width: 130px;">Ngày đặt</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->order_number }}</td>
                    <td>{{ $value->last_name . ' ' . $value->first_name }}</td>
                    <td>{{ $value->company_name }}</td>
                    <td>{{ $value->country }}</td>
                    <td>{{ $value->address_one }} </br> {{ $value->address_two }}</td>
                    <td>{{ $value->city }}</td>
                    <td>{{ $value->district }}</td>
                    <td>{{ $value->postcode }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->discount_code }}</td>
                    <td>@money($value->discount_amount)</td>
                    <td>@money($value->shipping_amount)</td>
                    <td>@money($value->total_amount)</td>
                    <td>{{ $value->payment_method }}</td>
                    <td>
                      <select id="{{ $value->id }}" class="form-control ChangeStatus" style="width: 130px;">
                        <option {{ $value->status == 0 ? 'selected' : '' }} value="0">Chờ xử lý</option>
                        <option {{ $value->status == 1 ? 'selected' : '' }} value="1">Chờ giao hàng</option>
                        <option {{ $value->status == 2 ? 'selected' : '' }} value="2">Đã giao hàng</option>
                        <option {{ $value->status == 3 ? 'selected' : '' }} value="3">Đã hoàn thành</option>
                        <option {{ $value->status == 4 ? 'selected' : '' }} value="4">Đã hủy</option>
                      </select>
                    </td>
                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    <td class="text-right">
                      <a class="dropdown-item" href="{{ route('admin.order.detail', $value->id) }}"><i
                          class="fa fa-eye m-r-5"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $('body').delegate('.ChangeStatus', 'change', function() {
      var status = $(this).val()
      var order_id = $(this).attr('id')
      $.ajax({
        type: 'GET',
        url: '{{ route('admin.order.status') }}',
        data: {
          status: status,
          order_id: order_id
        },
        dataType: 'json',
        success: function(data) {
          alert(data.message)
        },
        error: function(data) {

        }
      })
    })
  </script>
@endsection
