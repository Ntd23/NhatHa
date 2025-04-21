@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-9">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
        <div class="col-sm-3"><a href="{{ route('admin.order.index') }}" class="btn btn-success float-right btn-rounded"><i
              class="fa fa-backward"></i>
            Quay lại</a></div>
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @include('admin.layout.message')
      <div class="row">
        <div class="col-lg-12">
          <div class="card-box">
            <div class="form-group row">
              <label class="col-form-label">ID:<span>{{ $getRecord->id }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Mã đơn hàng:<span>{{ $getRecord->order_number }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Mã giao dịch:<span>{{ $getRecord->transaction_id }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Người mua
                hàng:<span>{{ $getRecord->last_name . ' ' . $getRecord->first_name }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Công ty:<span>{{ $getRecord->company_name }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Quốc gia:<span>{{ $getRecord->country }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Địa chỉ:<span>{{ $getRecord->address_one }}
                  ({{ $getRecord->address_two }})</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Quận/Huyện:<span>{{ $getRecord->district }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Mã bưu điện:<span>{{ $getRecord->postcode }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Điện thoại:<span>{{ $getRecord->phone }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Email:<span>{{ $getRecord->email }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Mã giảm giá:<span>{{ $getRecord->discount_code }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Đã giảm:<span>@money($getRecord->discount_amount)</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Giao hàng:<span>{{ $getRecord->getShipping->name }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Phí giao hàng:<span>@money($getRecord->shipping_amount)</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Thành tiền:<span>@money($getRecord->total_amount)</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Phương thức thành toán:<span>{{ $getRecord->payment_method }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Ghi chú:<span>{{ $getRecord->note }}</span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Tình trạng:<span>
                  @if ($getRecord->status == 0)
                    'Chờ xử lý'
                  @elseif ($getRecord->status == 1)
                    'Chờ giao hàng'
                  @elseif ($getRecord->status == 2)
                    'Đã giao hàng'
                  @elseif ($getRecord->status == 3)
                    'Đã hoàn thành'
                  @elseif ($getRecord->status == 4)
                    'Đã hủy'
                  @endif
                </span></label>
            </div>
            <div class="form-group row">
              <label class="col-form-label">Ngày
                đặt:<span>{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) }}</span></label>
            </div>
          </div>
        </div>
      </div>
			    <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Hình ảnh</th>
                  <th style="min-width: 150px;">Sản phẩm</th>
									 <th style="min-width: 130px;">Giá tiền</th>
                  <th style="min-width: 130px;">Số lượng</th>
                  <th style="min-width: 130px;">Size</th>
                  <th style="min-width: 130px;">Giá tiền (Size)</th>
                  <th style="min-width: 130px;">Thành tiền</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord->getItem as $item)
								@php
									$getProductImage=$item->getProduct->getImageSingle($item->getProduct->id);
								@endphp
                  <tr>
                    <td><img src="{{$getProductImage->getLogo()}}" style="width: 100px;height: 100px;"></td>
                    <td>
										<a href="{{route('front.category',$item->getProduct->slug)}}" target="_blank" rel="noopener noreferrer">
											{{$item->getProduct->title}}
										</a>
										</td>
                    <td>@money($item->price)</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->size_name }}</td>
                    <td>@money($item->size_amount)</td>
                    <td>@money($item->total_price)</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section('script')
    <script></script>
  @endsection
