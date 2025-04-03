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
          <form action="{{ route('admin.brand.store') }}" method="post">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Thương hiệu</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tên thương hiệu</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
              </div>
            </div>
            <div class="card-box">
              <h4 class="card-title">Hiển thị</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Slug</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                </div>
              </div>
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
            <div class="card-box">
              <h4 class="card-title">Meta</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta title</label>
                <div class="col-md-10">
                  <input type="text" class="form-control form-control-lg" name="meta_title"
                    value="{{ old('meta_title') }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta description</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="meta_description"
                    value="{{ old('meta_description') }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta keywords</label>
                <div class="col-md-10">
                  <input type="text" class="form-control form-control-sm" name="meta_keywords"
                    value="{{ old('meta_keywords') }}">
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
              <button class="btn btn-primary submit-btn">Thêm mới thương hiệu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
