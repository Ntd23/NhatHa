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
					<form action="{{route('admin.page.store')}}" method="post">
						{{csrf_field()}}
						<div class="card-box">
							<h4 class="card-title">Trang</h4>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Tên</label>
								<div class="col-md-10">
									<input type="text" class="form-control" name="name" value="{{ old('name') }}">
								</div>
							</div>
						<div class="m-t-20 text-center">
							<button class="btn btn-primary submit-btn">{{$header_title}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
