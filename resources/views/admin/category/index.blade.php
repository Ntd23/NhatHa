@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-4 col-3">
          <h4 class="page-title">Danh mục</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
          <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-right btn-rounded"><i
              class="fa fa-plus"></i>
            Thêm danh mục</a>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th style="min-width:80px;">Hình ảnh</th>
                  <th>Danh mục</th>
                  <th>Meta title</th>
                  <th>Meta description</th>
                  <th>Meta keyword</th>
                  <th style="min-width: 110px;">Ngày tạo</th>
                  <th style="min-width: 100px;">Người tạo</th>
                  <th style="min-width:150px;">Trang chủ</th>
                  <th style="min-width:150px;">Menu</th>
                  <th style="min-width:150px;">Trạng thái</th>
                  <th class="text-right">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>
                      @if (!empty($value->image_name))
                        <img width="40" height="40" src="{{ asset('storage/category/' . $value->image_name) }}">
                      @else
                        <img width="40" height="40" src="{{ asset('default/40x40.jpg') }}" />
                      @endif
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->meta_title }}</td>
                    <td>{{ $value->meta_description }}</td>
                    <td>{{ $value->meta_keywords }}</td>
                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>
                      <span class="custom-badge {{ $value->is_home == 1 ? 'status-green' : 'status-red' }}">
                        {{ $value->is_home == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                      </span>
                    </td>
                    <td><span class="custom-badge {{ $value->is_menu == 1 ? 'status-green' : 'status-red' }}">
                        {{ $value->is_menu == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                      </span>
                    </td>
                    <td>
                      <span class="custom-badge {{ $value->status == 0 ? 'status-green' : 'status-red' }}">
                        {{ $value->status == 0 ? 'Hoạt động' : 'Không hoạt động' }}
                      </span>
                    </td>
                    <td class="text-right">
                      <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{ route('admin.category.edit', $value->id) }}"><i
                              class="fa fa-pencil m-r-5"></i>Sửa</a>
                          <a class="dropdown-item" data-toggle="modal" id="delete_category"
                            data-id="{{ $value->id }}">
                            <i class="fa fa-trash-o m-r-5"></i>Xóa</a>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $('body').delegate('#delete_category', 'click', function() {
        let id = $(this).data('id')
        Swal.fire({
          title: 'Bạn muốn xóa danh mục này?',
          text: "Sau khi xóa không thể khôi phục.",
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
              url: "{{ route('admin.category.delete', ['id' => ':id']) }}".replace(':id', id),
              method: 'GET',
              data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
              },
              dataType: 'json',
              success: function(data) {
                if (data.status) {
                  Swal.fire(data.success,).then(() => {
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
