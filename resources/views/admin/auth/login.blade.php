@php
  $getSettingHeader = App\Models\SystemSetting::getSingle();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset($getSettingHeader->getFavicon()) }}">
  <title>ĐĂNG NHẬP QUẢN TRỊ</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
  <style>
    body {
      background: linear-gradient(135deg, #e6f0fa 0%, #ffffff 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      max-width: 400px;
      padding: 30px;
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login-card img {
      width: 60px;
      margin-bottom: 20px;
    }

    .form-group label {
      text-align: left;
      display: block;
      color: #333;
      font-weight: 500;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ced4da;
      padding: 10px;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .btn-primary {
      background: linear-gradient(90deg, #007bff, #00c4ff);
      border: none;
      border-radius: 25px;
      padding: 12px 40px;
      font-weight: 600;
      transition: background 0.3s;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #0056b3, #0096cc);
    }

    .form-check-label {
      color: #555;
    }
  </style>
</head>

<body>
  <div class="login-card">
    <img src="{{asset($getSettingHeader->getLogo())}}" alt="Logo" class="rounded-circle">
    <form action="{{ url('admin/login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email">
      </div>
      <div class="form-group">
        <label>Mật khẩu</label>
        <input type="password" class="form-control" name="password">
      </div>
      <div class="form-group form-check text-left">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Đăng Nhập Quản Trị</button>
    </form>
  </div>
  <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>


<!-- login23:12-->

</html>
