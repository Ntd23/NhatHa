@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-4 col-3">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
          <a href="{{ route('admin.page.create') }}" class="btn btn-primary float-right btn-rounded"><i
              class="fa fa-plus"></i>
            Thêm trang</a>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Trang</th>
                  <th>Tiêu đề</th>
                  <th class="text-right">Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->title }}</td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{ route('admin.page.edit', $value->id) }}"><i
                              class="fa fa-pencil m-r-5"></i>Sửa</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
@endsection
