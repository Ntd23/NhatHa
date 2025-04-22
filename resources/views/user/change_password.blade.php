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
        <h1 class="page-title">{{$meta_title}}</h1>
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
              <form action="{{ route('front.update_password') }}" method="POST">
                {{ csrf_field() }}
                <label>Mật khẩu hiện tại *</label>
                <input type="password" name="old_password" class="form-control" required>
                <div class="row">
                  <div class="col-md-6">
                    <label>Mật khẩu mới *</label>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label>Xác nhận mật khẩu *</label>
                    <input type="password" name="cpassword" class="form-control" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                  Xác nhận
                </button>
              </form>
            </div>
          </div><!-- End .col-lg-9 -->
        </div><!-- End .row -->
      </div><!-- End .container -->
    </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
  </main>
@endsection
