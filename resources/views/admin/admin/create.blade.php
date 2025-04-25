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
      <div class="row">
        <div class="col-lg-12">
          <form action="{{ route('admin.store') }}" method="post">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Quản trị viên</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tên người dùng</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Email</label>
                <div class="col-md-10">
                  <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mật khẩu</label>
                <div class="col-md-10">
                  <input class="form-control" type="password" name="password" value="{{ old('password') }}">
                </div>
              </div>
            </div>
            <div class="card-box">
              <h4 class="card-title">Hiển thị</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Trạng thái</label>
                <div class="col-md-10">
                  <select class="form-control" name="status">
                    <option>-- Chọn --</option>
                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Hoạt động</option>
                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Không hoạt động</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
              <button class="btn btn-primary">Thêm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
