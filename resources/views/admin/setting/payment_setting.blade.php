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
          <form action="{{ route('admin.update_payment_setting') }}" method="post">
            {{ csrf_field() }}
            <div class="card-box">
              <h4 class="card-title">Phương thức thanh toán</h4>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Thanh toán khi nhận hàng</label>
                <div class="col-md-9">
                  <input type="checkbox" name="is_cash_delivery"
                    {{ !empty($getRecord->is_cash_delivery) ? 'checked' : '' }}>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Stripe</label>
                <div class="col-md-9">
                  <input type="checkbox" name="is_stripe" {{ !empty($getRecord->is_stripe) ? 'checked' : '' }}>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Stripe Public Key</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="stripe_public_key"
                    value="{{ old('stripe_public_key', !empty($getRecord->stripe_public_key) ? $getRecord->stripe_public_key : '') }}">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3">Stripe Secret Key</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="stripe_secret_key"
                    value="{{ old('stripe_secret_key', !empty($getRecord->stripe_secret_key) ? $getRecord->stripe_secret_key : '') }}"">
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
