@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-12">
          <h4 class="page-title">Liên hệ</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          @include('admin.layout.message')
          <form method="get">
            {{ csrf_field() }}
            <div class="card-box row">
              <div class="form-group col-2">
                <label class="col-form-label">ID</label>
                <input class="form-control" type="text" name="id" value="{{ Request::get('id') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Tên</label>
                <input class="form-control" type="text" name="name" value="{{ Request::get('name') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Điện thoại</label>
                <input class="form-control" type="text" name="phone" value="{{ Request::get('phone') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Email</label>
                <input class="form-control" type="text" name="email" value="{{ Request::get('email') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Chủ đề</label>
                <input class="form-control" type="text" name="subject" value="{{ Request::get('subject') }}">
              </div>
              <div class="form-group col-6">
                <div class="row"><button class="btn btn-primary ml-3">Tìm kiếm</button>
                  <a href="{{ route('admin.contact') }}" class="btn btn-dark mx-3">Làm mới</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Khách hàng</th>
                  <th>Tên đăng nhập</th>
                  <th>Điện thoại</th>
                  <th>Email</th>
                  <th>Chủ đề</th>
                  <th>Nội dung</th>
                  <th>Ngày gửi</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ !empty($value->getUser) ? $value->getUser->name : '' }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->subject }}</td>
                    <td>{{ substr($value->message, 0, 30) }}</td>
                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    <td>
                      <a href="{{ route('admin.delete_contact', $value->id) }}"
                        onclick="return confirm('Bạn muốn xóa tin nhắn này?')"><i class="fa fa-trash-o m-r-5"></i>Xóa</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div style="padding: 10px; float: right;">
              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('pages'))->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
@endsection
