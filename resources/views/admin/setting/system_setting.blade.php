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
      @include('admin.layout.message')
      <div class="row">
        <div class="col-lg-12">
          <form action="{{ route('admin.update_system_setting') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Cài đặt chung</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Website name</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="website_name"
                    value="{{ $getRecord->website_name }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Logo</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="logo">
                  @if (!empty($getRecord->getLogo()))
                    <img src="{{ $getRecord->getLogo() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Favicon</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="favicon">
                  @if (!empty($getRecord->getFavicon()))
                    <img src="{{ $getRecord->getFavicon() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Footer payment icon</label>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="footer_payment_icon">
                  @if (!empty($getRecord->getFooterPaymentIcon()))
                    <img src="{{ $getRecord->getFooterPaymentIcon() }}" style="width: 200px;">
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Footer description</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="footer_description" value="{{ $getRecord->footer_description }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Address</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="address"
                    value="{{ $getRecord->address }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Phone</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="phone"
                    value="{{ $getRecord->phone }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Phone two</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="phone_two"
                    value="{{ $getRecord->phone_two }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Submit contact email</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="submit_email"
                    value="{{ $getRecord->submit_email }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Email</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="email"
                    value="{{ $getRecord->email }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Email two</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="email_two"
                    value="{{ $getRecord->email_two }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Working hours</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="working_hours"
                    value="{{ $getRecord->working_hours }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Facebook link</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="fb_link"
                    value="{{ $getRecord->fb_link }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Instagram link</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="ig_link"
                    value="{{ $getRecord->ig_link }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Youtobe link</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="ytb_link"
                    value="{{ $getRecord->ytb_link }}">
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
