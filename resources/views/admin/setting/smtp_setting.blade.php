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
          <form action="{{ route('admin.update_smtp_setting') }}" method="post">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">SMTP</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Website name</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail mailer</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_mailer" value="{{ $getRecord->mail_mailer }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail host</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_host" value="{{ $getRecord->mail_host }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail port</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_port" value="{{ $getRecord->mail_port }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail username</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_username" value="{{ $getRecord->mail_username }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail password</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_password" value="{{ $getRecord->mail_password }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail encryption</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_encryption" value="{{ $getRecord->mail_encryption }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Mail from address</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="mail_from_address" value="{{ $getRecord->mail_from_address }}">
                </div>
              </div>
            </div>
            <div class="m-t-20 text-center">
              <button class="btn btn-primary submit-btn">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
