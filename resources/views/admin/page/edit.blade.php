@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title">Cập nhật trang</h4>
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
          <form action="{{ route('admin.page.update', $getRecord->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Trang</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tên</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tiêu đề</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="title" value="{{ old('title', $getRecord->title) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Ảnh</label>
                <div class="col-md-10">
                  <input class="form-control" type="file" name="image_name">
                  @if (!empty($getRecord->getImage()))
                    <img src="{{ $getRecord->getImage() }}" style="width: 150px;">
                  @endif
                </div>
              </div>
            </div>
            <div class="card-box">
              <h4 class="card-title">Meta</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta title</label>
                <div class="col-md-10">
                  <input type="text" class="form-control form-control-lg" name="meta_title"
                    value="{{ old('meta_title', $getRecord->meta_title) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta description</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="meta_description"
                    value="{{ old('meta_description', $getRecord->meta_desciption) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta keywords</label>
                <div class="col-md-10">
                  <input type="text" class="form-control form-control-sm" name="meta_keywords"
                    value="{{ old('meta_keywords', $getRecord->meta_keywords) }}">
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
