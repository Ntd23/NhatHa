@extends('app')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection

@section('content')
  <main class="main">
	@include('layout._message')
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item" aria-current="page">{{ $meta_title }}</li>
        </ol>
      </div>
    </nav>
    <div class="page-content">
      <div class="container">
          <div class="row">
            <div class="col-lg-12">
							@include('product._list')
            </div>
            <div class="col-lg-12">
             {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('pages'))->links() !!}
            </div>
          </div>
      </div>
    </div>
  </main>
@endsection
