@extends('app')
@section('style')
  <style>
    .box-btn {
      height: 110px;
      text-align: center;
      border-radius: 5px;
      box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }
  </style>
@endsection
@section('content')
  <main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $getPage->title }}</li>
        </ol>
      </div>
    </nav>
    <div class="container">
      <div class="page-header page-header-big text-center" style="background-image: url('{{ $getPage->getImage() }}')">
        <h1 class="page-title text-white">{{ $getPage->title }}</h1>
      </div>
    </div>
    <div class="page-content pb-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-2 mb-lg-0">
            {!! $getPage->description !!}
            <div class="row">
              <div class="col-sm-7">
                <div class="contact-info">
                  <ul class="contact-list">
                    @if (!empty($getSystemSetting->address))
                      <li>
                        <i class="icon-map-marker"></i>{{ $getSystemSetting->address }}
                      </li>
                    @endif
                    @if (!empty($getSystemSetting->phone))
                      <li>
                        <i class="icon-phone"></i>
                        <a href="tel:{{ $getSystemSetting->phone }}">{{$getSystemSetting->phone}}</a>
                      </li>
                    @endif
                    @if (!empty($getSystemSetting->phone_two))
                      <li>
                        <i class="icon-phone"></i>
                        <a href="tel:{{ $getSystemSetting->phone_two }}">{{$getSystemSetting->phone_two}}</a>
                      </li>
                    @endif
                    @if (!empty($getSystemSetting->email))
                      <li>
                        <i class="icon-envelope"></i>
                        <a href="mailto:{{ $getSystemSetting->email }}">{{ $getSystemSetting->email }}</a>
                      </li>
                    @endif
                    @if (!empty($getSystemSetting->email_two))
                      <li>
                        <i class="icon-envelope"></i>
                        <a href="mailto:{{ $getSystemSetting->email_two }}">{{ $getSystemSetting->email_two }}</a>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="contact-info">
                  <ul class="contact-list">
                    @if (!empty($getSystemSetting->working_hours))
                      <li>
                        <i class="icon-envelope"></i>
                        <a href="mailto:{{ $getSystemSetting->working_hours }}">{{ $getSystemSetting->working_hours }}</a>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
					@include('layout._message')
            <h2 class="title mb-1">Bạn có thắc mắc?</h2>
            <p class="mb-2">Nhập thắc mắc của bạn vào biểu mẫu để được nhân viên tư vấn</p>
            <form action="{{route('front.submit_contact')}}" method="post" class="contact-form mb-3">
						{{csrf_field()}}
              <div class="row">
                <div class="col-sm-6">
                  <label for="cname" class="sr-only">Name</label>
                  <input type="text" class="form-control" id="cname" name="name" required>
                </div>
                <div class="col-sm-6">
                  <label for="cemail" class="sr-only">Email</label>
                  <input type="email" class="form-control" id="cemail" name="email" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="cphone" class="sr-only">Phone</label>
                  <input type="tel" class="form-control" id="cphone" name="phone">
                </div>
                <div class="col-sm-6">
                  <label for="csubject" class="sr-only">Subject</label>
                  <input type="text" class="form-control" id="csubject" name="subject">
                </div>
              </div>
              <label for="cmessage" class="sr-only">Message</label>
              <textarea class="form-control" cols="30" rows="4" id="cmessage" name="message" required></textarea>
              <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                <span>GỬI NGAY</span>
                <i class="icon-long-arrow-right"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div id="map"></div>
    </div>
  </main>
@endsection
