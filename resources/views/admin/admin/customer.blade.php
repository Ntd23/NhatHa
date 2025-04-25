@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-4 col-3">
          <h4 class="page-title">Tổng số khách hàng: {{ $getRecord->total() }}</h4>
        </div>
      </div>
			 <div class="row">
        <div class="col-lg-12">
          <form method="get">
            {{ csrf_field() }}
            <div class="card-box row">
              <div class="form-group col-2">
                <label class="col-form-label">ID</label>
                <input class="form-control" type="text" name="id" value="{{ Request::get('id') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Tên người dùng</label>
                <input class="form-control" type="text" name="name" value="{{ Request::get('name') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Email</label>
                <input class="form-control" type="text" name="email" value="{{ Request::get('email') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Quốc gia</label>
                <input class="form-control" type="text" name="country" value="{{ Request::get('country') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Quận/Huyện</label>
                <input class="form-control" type="text" name="district" value="{{ Request::get('district') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Thành phố</label>
                <input class="form-control" type="text" name="city" value="{{ Request::get('city') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Mã bưu điện</label>
                <input class="form-control" type="text" name="postcode" value="{{ Request::get('postcode') }}">
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
                <label class="col-form-label">Từ ngày</label>
                <input class="form-control" type="date" name="from_date" value="{{ Request::get('from_date') }}">
              </div>
              <div class="form-group col-2">
                <label class="col-form-label">Đến ngày</label>
                <input class="form-control" type="date" name="to_date" value="{{ Request::get('to_date') }}">
              </div>
              <div class="form-group col-6">
                <div class="row"><button class="btn btn-primary ml-3">Tìm kiếm</button>
                  <a href="{{ route('admin.order.index') }}" class="btn btn-dark mx-3">Làm mới</a>
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
                  <th>Email</th>
                  <th>Trạng thái</th>
									<th>Ngày tạo</th>
                  <th class="text-right">Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>
                      <span class="custom-badge {{ $value->status == 0 ? 'status-green' : 'status-red' }}">
                        {{ $value->status == 0 ? 'Hoạt động' : 'Không hoạt động' }}
                      </span>
                    </td>
										<td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" data-toggle="modal" id="delete_customer" data-id="{{ $value->id }}">
                            <i class="fa fa-trash-o m-r-5"></i>Xóa</a>
                        </div>
                      </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $('body').delegate('#delete_customer', 'click', function() {
        let id = $(this).data('id')
        Swal.fire({
          title: 'Bạn muốn xóa khách hàng này?',
          icon: 'warning',
          width: '700',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Xóa',
          cancelButtonText: 'Bỏ qua'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ route('admin.delete', ['id' => ':id']) }}".replace(':id', id),
              method: 'GET',
              data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
              },
              dataType: 'json',
              success: function(data) {
                if (data.status) {
                  Swal.fire({
                    title: "Đã xóa!",
                    text: data.success,
                    icon: "success"
                  }).then(() => {
                    location.reload();
                  });
                }
              },
              error: function(xhr) {
                Swal.fire('Error!', 'Có lỗi xảy ra, vui lòng thử lại!', 'error');
              }
            });
          }
        });

      })
    })
  </script>
@endsection
