 @php
  $getSystemSettingApp = App\Models\SystemSetting::getSingle();
  @endphp
<!DOCTYPE html>
<html lang="en">

<head>
	@include('layout.css')
	@yield('css')
	<style>
		 .btn-wishlist-add::before {
      content: '\f233' !important;
    }
	</style>
</head>

<body>
	<div class="page-wrapper">
		@include('layout.header')
		@yield('content')
		@include('layout.footer')
	</div>
	<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
	@include('layout.mobile')
	<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="icon-close"></i></span>
					</button>
					<div class="form-box">
						<div class="form-tab">
							<ul class="nav nav-pills nav-fill" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
										aria-controls="signin" aria-selected="true">Sign In</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
										aria-controls="register" aria-selected="false">Register</a>
								</li>
							</ul>
							<div class="tab-content" id="tab-content-5">
								<div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
									<form id="SubmitFormLogin" method="POST">
										{{ csrf_field() }}
										<div class="form-group">
											<label for="singin-email">Email Address *</label>
											<input type="text" class="form-control" id="singin-email" name="email" required>
										</div>
										<div class="form-group">
											<label for="singin-password">Password *</label>
											<input type="password" class="form-control" id="singin-password" name="password" required>
										</div>
										<div class="form-footer">
											<button type="submit" class="btn btn-outline-primary-2">
												<span>LOG IN</span>
												<i class="icon-long-arrow-right"></i>
											</button>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="is_remember" class="custom-control-input" id="signin-remember">
												<label class="custom-control-label" for="signin-remember">Remember
													Me</label>
											</div>
											<a href="{{ url('forgot-password') }}" class="forgot-link">Forgot Your Password?</a>
										</div>
									</form>
									<div class="form-choice">
										<p class="text-center"><a href="{{ url('login-google') }}" class="btn btn-login btn-g">
												<i class="icon-google"></i>
												Login With Google
											</a></p>
									</div>
								</div>
								<div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
									<form action="#" id="SubmitFormRegister" method="POST">
										{{ csrf_field() }}
										<div class="form-group">
											<label for="register-name">Tên đăng nhập <span style="color: red">*</span></label>
											<input type="text" class="form-control" id="register-name" name="name" required>
										</div>
										<div class="form-group">
											<label for="register-email">Địa chỉ email <span style="color: red">*</span></label>
											<input type="email" class="form-control" id="register-email" name="email" required>
										</div>
										<div class="form-group">
											<label for="register-password">Mật khẩu <span style="color: red">*</span></label>
											<input type="password" class="form-control" id="register-password" name="password" required>
										</div>
										<div class="form-footer">
											<button type="submit" class="btn btn-outline-primary-2">
												<span>ĐĂNG KÝ</span>
												<i class="icon-long-arrow-right"></i>
											</button>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="register-policy" required>
												<label class="custom-control-label" for="register-policy">I agree to the
													<a href="#">privacy policy</a> *</label>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('layout.script')
	@yield('script')
	{{-- functions other --}}
	<script>
		//register
		$('body').delegate('#SubmitFormRegister', 'submit', function (e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '{{ url('register') }}',
				data: $(this).serialize(),
				dataType: 'json',
				success: function (data) {
					if (data.status == true) {
						Swal.fire({
							title: data.message,
							icon: "success",
							width: 800,
						});
						setTimeout(() => {
							window.location.href = '/'
						}, 2000)
					} else {
						console.log(data)
						Swal.fire({
							title: data.message,
							icon: "warning",
							width: 800,
						});
					}
				}
			})
		})
		$('body').delegate('#SubmitFormLogin', 'submit', function (e) {
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: '{{ url('login') }}',
				data: $(this).serialize(),
				dataType: 'json',
				success: function (data) {
					if (data.status == true) {
						Swal.fire({
							title: data.message,
							icon: "success",
							width: 800,
						});
						window.location.href = '/'
					} else {
						Swal.fire({
							title: data.message,
							icon: "warning",
							width: 800,
						});
					}
				}
			})
		})
		$('body').delegate('.add_to_wishlist','click',function() {
			var product_id= $(this).attr('id')
			$.ajax({
				type:'POST',
				url: '{{route('front.add_to_wishlist')}}',
				data: {
					'_token': '{{csrf_token()}}',
					product_id: product_id,
				},
				dataType:'json',
				success: function(data) {
					if(data.is_wishlist==0) $('.add_to_wishlist'+product_id).removeClass('btn-wishlist-add')
					else $('.add_to_wishlist'+product_id).addClass('btn-wishlist-add')
				},
				error: function(data) {}
			})
		})
	</script>
</body>

</html>
