@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title">{{$header_title}}</h4>
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
          <form action="{{ route('admin.discountcode.update',$getRecord->id) }}" method="post">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Mã giảm giá</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Mã giảm giá</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" name="name" value="{{ old('name', $getRecord->name) }}">
                </div>
              </div>
								<div class="form-group row">
                <label class="col-form-label col-md-2">Loại</label>
                <div class="col-md-10">
                  <select class="form-control" name="type">
                    <option @selected(old('status', $getRecord->status)=='Amount') value="0">Tổng</option>
                    <option @selected(old('status', $getRecord->status)=='Percent') value="1">Phần trăm</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-2">Phần trăm / Tổng</label>
                <div class="col-md-10">
                  <input type="text" class="form-control" name="percent_amount" value="{{ old('percent_amount',$getRecord->percent_amount) }}">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-2">Hạn sử dụng</label>
                <div class="col-md-10">
                  <input type="date" class="form-control" name="expire_date" value="{{ old('expire_date',$getRecord->expire_date) }}">
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
                    <option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }} value="0">Hoạt động</option>
                    <option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }} value="1">Không hoạt động</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="m-t-20 text-center">
              <button class="btn btn-primary submit-btn">Cập nhật mã giảm giá</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
