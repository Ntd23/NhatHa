<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/img/favicon.ico')}}">
  <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
  <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
  <div class="main-wrapper account-wrapper">
    <div class="account-page">
      <div class="account-center">
        <div class="account-box">
          <form action="{{url('admin/login')}}" class="form-signin" method="post">
            {{csrf_field()}}
            <div class="account-logo">
              <a href="index-2.html"><img src="assets/img/logo-dark.png" alt=""></a>
            </div>
            @include('admin.layout.message')
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group d-flex justify-content-between">
              <div><input type="checkbox" name="remember" id=""> <label for="">Remember me</label>
              </div>

              <a href="forgot-password.html">Forgot your password?</a>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary account-btn">Đăng nhập quản trị</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  <script src="{{asset('admin/assets/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/app.js')}}"></script>
</body>


<!-- login23:12-->

</html>
