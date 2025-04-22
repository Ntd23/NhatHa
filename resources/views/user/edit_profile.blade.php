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
                @include('layout._message')
                <div class="tab-content">
                  <form action="{{ route('front.update_profile') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-sm-6">
                        <label>Tên *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $getRecord->name }}">
                      </div>
                      <div class="col-sm-6">
                        <label>Họ *</label>
                        <input type="text" name="last_name" class="form-control">
                      </div>
                    </div>
                    <label>Địa chỉ email *</label>
                    <input type="email" name="email" class="form-control" value="{{ $getRecord->email }}">
                    <label>Công ty (Optional)</label>
                    <input type="text" name="company_name" class="form-control" value="{{ $getRecord->company_name }}">
                    <label>Quốc gia *</label>
                    <input type="text" name="country" class="form-control" value="{{ $getRecord->country }}">
                    <label>Địa chỉ (Số nhà, Đường / Văn phòng, Chung cư) *</label>
                    <input type="text" name="address_one" class="form-control" value="{{ $getRecord->address_one }}">
                    <input type="text" name="address_two" class="form-control" value="{{ $getRecord->address_two }}">
                    <div class="row">
                      <div class="col-sm-6">
                        <label>Thành phố *</label>
                        <input type="text" name="city" class="form-control" value="{{ $getRecord->city }}">
                      </div>
                      <div class="col-sm-6">
                        <label>Quận (Huyện) *</label>
                        <input type="text" name="district" class="form-control" value="{{ $getRecord->district }}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label>Mã bưu điện *</label>
                        <input type="text" name="postcode" value="{{ $getRecord->postcode }}" class="form-control">
                      </div>
                      <div class="col-sm-6">
                        <label>Điện thoại *</label>
                        <input type="tel" name="phone" class="form-control" value="{{ $getRecord->phone }}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                      Xác nhận
                    </button>
                  </form>
                </div>
              </div><!-- End .col-lg-9 -->
          </div><!-- End .container -->
        </div><!-- End .dashboard -->
      </div><!-- End .page-content -->
		</div>
  </main>
@endsection
