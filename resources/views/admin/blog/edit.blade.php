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
          <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Bài viết</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Danh mục</label>
                <div class="col-md-10">
                  <select class="form-control" name="blog_category_id" required>
                    <option value="">Chọn</option>
                    @foreach ($getCategory as $category)
                      <option {{ $getRecord->blog_category_id == $category->id ? 'selected' : '' }}
                        value="{{ $category->id }}">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Tiêu đề</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" name="title" value="{{ old('title', $getRecord->title) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Hình ảnh</label>
                <div class="col-md-10">
                  <input class="form-control" type="file" name="image_name">
                  @if (!empty($getRecord->getImage()))
                    <img src="{{ $getRecord->getImage() }}" width="150px">
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mô tả ngắn</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="short_description">{{ old('short_description', $getRecord->short_description) }}"</textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mô tả</label>
                <div class="col-md-10">
                  <textarea class="form-control editor" name="description">{{ old('description', $getRecord->description) }}"</textarea>
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
                    <option {{ $getRecord->status == 0 ? 'selected' : '' }} value="0">Hoạt động</option>
                    <option {{ $getRecord->status == 1 ? 'selected' : '' }} value="1">Không hoạt động</option>
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
                    value="{{ old('meta_title', $getRecord->meta_title) }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Meta description</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="meta_description"
                    value="{{ old('meta_description', $getRecord->meta_description) }}">
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
              <button class="btn btn-primary submit-btn">Thêm mới bài viết</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
