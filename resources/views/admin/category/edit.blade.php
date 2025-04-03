@extends('admin.layout.app')
@section('content')
	<div class="page-wrapper">
		<div class="content">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title">Thêm danh mục</h4>
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
					<form action="{{route('admin.category.update', $getRecord->id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="card-box">
							<h4 class="card-title">Danh mục</h4>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Tên danh mục</label>
								<div class="col-md-10">
									<input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Ảnh</label>
								<div class="col-md-10">
									<input class="form-control" type="file" name="image">
									@if (!empty($getRecord->image_name))
										<img src="{{asset('storage/category/' . $getRecord->image_name)}}" style="width: 100px;height: 100px;" alt="">
									@endif
								</div>
							</div>
						</div>
						<div class="card-box">
							<h4 class="card-title">Hiển thị</h4>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Slug</label>
								<div class="col-md-10">
									<input type="text" class="form-control" name="slug" value="{{ old('slug', $getRecord->slug) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Nút</label>
								<div class="col-md-10">
									<input type="text" class="form-control" name="button_name"
										value="{{ old('button_name', $getRecord->button_name) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Trạng thái</label>
								<div class="col-md-10">
									<select class="form-control" name="status">
										<option>-- Chọn --</option>
										<option {{ old('status', $getRecord->status) == 0 ? 'selected' : '' }} value="0">Hoạt động</option>
										<option {{ old('status', $getRecord->status) == 1 ? 'selected' : '' }} value="1">Không hoạt động
										</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="is_home" {{ !empty($getRecord->is_home) ? 'checked' : '' }}>
											Màn hình trang chủ
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="is_menu" {{ !empty($getRecord->is_menu) ? 'checked' : '' }}> Hiển thị
											menu
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="card-box">
							<h4 class="card-title">Meta</h4>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Meta title</label>
								<div class="col-md-10">
									<input type="text" class="form-control form-control-lg" name="meta_title"
										value="{{ old('meta_title', $getRecord->meta_title) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Meta description</label>
								<div class="col-md-10">
									<input type="text" class="form-control" name="meta_description"
										value="{{ old('meta_description', $getRecord->meta_description) }}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-form-label col-md-2">Meta keywords</label>
								<div class="col-md-10">
									<input type="text" class="form-control form-control-sm" name="meta_keywords"
										value="{{ old('meta_keywords', $getRecord->meta_keywords) }}">
								</div>
							</div>
						</div>
						<div class="m-t-20 text-center">
							<button class="btn btn-primary submit-btn">Chỉnh sửa danh mục</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
