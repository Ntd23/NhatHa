@extends('app')
@section('content')
  <main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $getPage->title }}</li>
        </ol>
      </div>
    </nav>
    <div class="container">
      <div class="page-header page-header-big text-center"
        style="background-image: url('{{ url($getPage->getImage()) }}')">
        <h1 class="page-title text-white">{{ $getPage->title }}</h1>
      </div>
    </div>
    <div class="page-content pb-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-3 mb-lg-0">
            {!! $getPage->description !!}
          </div>
        </div>
        <div class="mb-5">
        </div>
      </div>
  </main>
@endsection
