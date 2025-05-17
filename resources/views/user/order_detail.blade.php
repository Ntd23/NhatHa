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
        <h1 class="page-title">Theo dõi đơn hàng</h1>
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
                @include('layout._message')
                <div>
                  <div class="form-group">
                    <label>Mã đặt hàng : <span class="font-weight-normal">{{ $getRecord->order_number }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Họ tên : <span
                        class="font-weight-normal">{{ $getRecord->last_name . ' ' . $getRecord->first_name }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Công ty : <span class="font-weight-normal">{{ $getRecord->company_name }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Quốc gia : <span class="font-weight-normal">{{ $getRecord->country }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Địa chỉ : <span
                        class="font-weight-normal">{{ $getRecord->address_one . ' , ' . $getRecord->address_two }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Thành phố : <span class="font-weight-normal">{{ $getRecord->city }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Quận/Huyện : <span class="font-weight-normal">{{ $getRecord->district }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Mã bưu điện : <span class="font-weight-normal">{{ $getRecord->postcode }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Điện thoại : <span class="font-weight-normal">{{ $getRecord->phone }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Mã giảm giá : <span class="font-weight-normal">{{ $getRecord->discount_code }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Đã giảm : <span class="font-weight-normal">@money($getRecord->discount_amount)</span></label>
                  </div>
                  <div class="form-group">
                    <label>Giao hàng : <span
                        class="font-weight-normal">{{ $getRecord->getShipping->name }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Phí giao hàng : <span class="font-weight-normal">@money($getRecord->shipping_amount)</span></label>
                  </div>
                  <div class="form-group">
                    <label>Thành tiền : <span class="font-weight-normal">@money($getRecord->total_amount)</span></label>
                  </div>
                  <div class="form-group">
                    <label>Phương thức thanh toán : <span
                        class="font-weight-normal">{{ $getRecord->payment_method }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Ghi chú: <span class="font-weight-normal">{{ $getRecord->note }}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Trạng thái : <span class="font-weight-normal">
                        @if ($getRecord->status == 0)
                          Chờ xác nhận
                        @elseif ($getRecord->status == 1)
                          Chờ giao hàng
                        @elseif ($getRecord->status == 2)
                          Đã giao hàng
                        @elseif ($getRecord->status == 3)
                          Đã hoàn thành
                        @elseif ($getRecord->status == 4)
                          Đã hủy
                        @endif
                      </span></label>
                  </div>
                  <div class="form-group">
                    <label>Ngày đặt : <span
                        class="font-weight-normal">{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</span></label>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header mt-2">
                    <h3 class="card-title">Thông tin sản phẩm</h3>
                  </div>
                  <div class="card-body p-0" style="overflow: auto;">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Hình ảnh</th>
                          <th>Sản phẩm</th>
                          <th>Số tiền (Size)</th>
                          <th>Số lượng</th>
                          <th>Tổng</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($getRecord->getItem as $item)
                          @php
                            $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                          @endphp
                          <tr>
                            <td>
                              <img src="{{ $getProductImage->getLogo() }}" style="width: 100px;height: 100px;">
                            </td>
                            <td>
                              <a href="{{ route('front.category', $item->getProduct->slug) }}" target="_blank"
                                rel="noopener noreferrer">
                                {{ substr($item->getProduct->title, 0, 30) . '...' }}</a>
                              @if (!empty($item->size_name))
                                <br>
                                <b>Size(Loại):</b>{{ $item->size_name }}
                              @endif

                              @if ($getRecord->status == 3)
                                @php
                                  $getReview = $item->getReview($item->getProduct->id, $getRecord->id);
                                @endphp
                                @if (!empty($getReview))
                                  Đánh giá: {{ ' '. $getReview->rating }} <br />
                                  <b>Ý kiến: </b> {{ $getReview->review }}
                                @else
                                  <button class="btn btn-outline-danger MakeReview" id="{{ $item->getProduct->id }}"
                                    data-order={{ $getRecord->id }}>Đánh giá</button>
                                @endif
                              @endif
                            </td>
                            <td>@money($item->size_amount)</td>
                            <td>{{ $item->quantity }}</td>
                            <td>@money($item->total_price)</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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

{{-- modal --}}
<div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="MakeReviewModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="MakeReviewModalLabel">Đánh giá</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('front.submit_review')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="product_id" id="getProductId" required>
        <input type="hidden" name="order_id" id="getOrderId" required>
        <div class="modal-body p-5">
          <div class="form-group mb-3">
            <select name="rating" class="form-control" required>
              <option value="">Chọn *</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Đánh giá *</label>
            <textarea class="form-control" name="review" required></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Gửi</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@section('script')
<script>
	$('body').delegate('.MakeReview','click', function(){
		var product_id= $(this).attr('id')
		var order_id= $(this).attr('data-order')
		$('#getProductId').val(product_id)
		$('#getOrderId').val(order_id)
		$('#MakeReviewModal').modal('show')
	})
</script>
@endsection
