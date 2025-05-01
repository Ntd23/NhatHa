@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
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
          <form action="{{ route('admin.update_home_setting') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Hiển thị trang chủ</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề sản phẩm thịnh hành</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="trendy_product_title"
                    value="{{ $getRecord->trendy_product_title }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề mua sắm danh mục</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="shop_category_title"
                    value="{{ $getRecord->shop_category_title }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề ghé thăm gần đây</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="recent_arrival_title"
                    value="{{ $getRecord->recent_arrival_title }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề giao hàng thanh toán</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="payment_delivery_title"
                    value="{{ $getRecord->payment_delivery_title }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mô tả giao hàng thanh toán</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="payment_delivery_description"
                    value="{{ $getRecord->payment_delivery_description }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Hình ảnh giao hàng thanh toán</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="payment_delivery_image">
                  @if (!empty($getRecord->getPaymentDeliveryImage()))
                    <img src="{{ $getRecord->getPaymentDeliveryImage() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề bồi thường</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="refund_title" value="{{ $getRecord->refund_title }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mô tả bồi thường</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="refund_description"
                    value="{{ $getRecord->refund_description }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Hình ảnh bồi thường</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="refund_image">
                  @if (!empty($getRecord->getRefundImage()))
                    <img src="{{ $getRecord->getRefundImage() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề hỗ trợ</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="suport_title"
                    value="{{ $getRecord->suport_title }}">
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Mô tả hỗ trợ</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="suport_description"
                    value="{{ $getRecord->suport_description }}">
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Hình ảnh hỗ trợ</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="support_image">
                  @if (!empty($getRecord->getSupportImage()))
                    <img src="{{ $getRecord->getSupportImage() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Tiêu đề đăng ký</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="signup_title"
                    value="{{ $getRecord->signup_title }}">
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Mô tả đăng ký</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="signup_description"
                    value="{{ $getRecord->signup_description }}">
                </div>
              </div>
							<div class="form-group row">
                <label class="col-form-label col-md-3">Hình ảnh đăng ký</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="signup_image">
                  @if (!empty($getRecord->getSignupImage()))
                    <img src="{{ $getRecord->getSignupImage() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
              <button class="btn btn-primary submit-btn">Cập nhật</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
