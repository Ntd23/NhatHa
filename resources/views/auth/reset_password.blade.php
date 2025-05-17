@extends('app')
@section('style')
@endsection
@section('content')
  <main class="main">
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
      style="background-image: url('{{ url('assets/images/backgrounds/login-bg.jpg') }}')">
      <div class="container">
        <div class="form-box">
          <div class="form-tab">
            <ul class="nav nav-pills nav-fill" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab"
                  aria-controls="signin-2" aria-selected="false">Khôi phục mật khẩu</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="d-block">
                @include('layout._message')
                <form action="" method="POST">
                  {{ csrf_field() }}
                  <div class="form-group mt-3">
                    <label for="email-2">Mật khẩu mới *</label>
                    <input type="password" class="form-control" id="email-2" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="email-2">Nhập lại mật khẩu *</label>
                    <input type="password" class="form-control" id="email-2" name="cpassword" required>
                  </div>
                  <div class="form-footer">
                    <button type="submit" class="btn btn-outline-primary-2">
                      <span>Khôi phục</span>
                      <i class="icon-long-arrow-right"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
@section('script')
@endsection
