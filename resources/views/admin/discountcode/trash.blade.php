@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-4 col-3">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
        <div class="col-sm-8 col-9 m-b-20 text-right">
				<a href="{{route('admin.brand.index')}}" class="btn btn-secondary float-right btn-rounded"><i class="fa fa-left"></i>Quay về</a>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Thương hiệu</th>
                  <th>Meta title</th>
                  <th>Meta description</th>
                  <th>Meta keyword</th>
                  <th style="min-width: 100px;">Người tạo</th>
                  <th style="min-width: 110px;">Ngày tạo</th>
                  <th style="min-width:150px;">Trạng thái</th>
                  <th class="text-right">Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->meta_title }}</td>
                    <td>{{ $value->meta_description }}</td>
                    <td>{{ $value->meta_keywords }}</td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
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
                          <a class="dropdown-item m-auto" href="{{ route('admin.brand.restore', $value->id) }}"><i class="fa fa-window-restore text-secondary mr-2"></i>Khôi phục</a>
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
