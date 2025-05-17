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
                   <div id="notification" style="display: none;color: red"></div>
                   <form id="SubmitFormLogin" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                       <label for="singin-email">Email *</label>
                       <input type="text" class="form-control" id="singin-email" name="email">
                     </div>
                     <div class="form-group">
                       <label for="singin-password">Mật khẩu *</label>
                       <input type="password" class="form-control" id="singin-password" name="password">
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
                       <a href="{{ route('forgot_password') }}" class="forgot-link">Quên mật khẩu?</a>
                     </div>
                   </form>
                   <div class="form-choice">
                     <p class="text-center"><a href="{{ route('login_google_form') }}" class="btn btn-login btn-g">
                         <i class="icon-google"></i>
                         Login With Google
                       </a></p>
                   </div>
                 </div>
                 <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                   <div id="notification" style="display: none;color: red"></div>
                   <form action="#" id="SubmitFormRegister" method="POST">
                     {{ csrf_field() }}
                     <div class="form-group">
                       <label for="register-name">Tên đăng nhập <span style="color: red">*</span></label>
                       <input type="text" class="form-control" id="register-name" name="name">
                     </div>
                     <div class="form-group">
                       <label for="register-email">Địa chỉ email <span style="color: red">*</span></label>
                       <input type="string" class="form-control" id="register-email" name="email">
                     </div>
                     <div class="form-group">
                       <label for="register-password">Mật khẩu <span style="color: red">*</span></label>
                       <input type="password" class="form-control" id="register-password" name="password">
                     </div>
                     <div class="form-footer">
                       <button type="submit" class="btn btn-outline-primary-2">
                         <span>ĐĂNG KÝ</span>
                         <i class="icon-long-arrow-right"></i>
                       </button>
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
     $('body').delegate('#SubmitFormRegister', 'submit', function(e) {
       e.preventDefault();
       $.ajax({
         type: 'POST',
         url: '{{ url('register') }}',
         data: $(this).serialize(),
         dataType: 'json',
         success: function(data) {
           var notification = document.getElementById('notification');
           notification.style.display = 'block';
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
             notification.className = 'error';
             notification.innerHTML = data.message + (data.errors ? '<br>' + data.errors.join('<br>') : '');
             console.log(data)
             Swal.fire({
               title: data.message,
               icon: "warning",
               width: 800,
             });
           }
         },
         error: function(xhr) {
           if (xhr.status === 422) {
             var data = xhr.responseJSON || {
               status: false,
               message: 'Dữ liệu không hợp lệ.',
               errors: {}
             };
             console.log(data)

             var notification = document.getElementById('notification');
             notification.style.display = 'block';
             notification.className = 'error';
             // Xử lý lỗi validation
             let errorMessages = [];
             if (data.errors && typeof data.errors === 'object') {
               errorMessages = Object.values(data.errors).flat().map(msg => msg);
             } else {
               errorMessages = [data.message || 'Đã xảy ra lỗi.'];
             }

             notification.innerHTML = (data.message || 'Lỗi validation') + (errorMessages.length ? '<br>' +
               errorMessages.join('<br>') : '');

             // Hiển thị Swal.fire cho lỗi
             Swal.fire({
               title: data.message || 'Dữ liệu không hợp lệ.',
               html: errorMessages.join('<br>'),
               icon: 'error',
               width: 800,
             });
           }
         }
       })
     })
     $('body').delegate('#SubmitFormLogin', 'submit', function(e) {
       e.preventDefault();
       $.ajax({
         type: 'POST',
         url: '{{ url('login') }}',
         data: $(this).serialize(),
         dataType: 'json',
         success: function(data) {
           var notification = document.getElementById('notification');
           notification.style.display = 'block';
           if (data.status == true) {
             Swal.fire({
               title: data.message,
               icon: "success",
               width: 800,
             });
             window.location.href = '/'
           } else {
             notification.className = 'error';
             const errorMessages = data.errors && typeof data.errors === 'object' ?
               Object.values(data.errors).flat() :
               [data.message || 'Đã xảy ra lỗi.'];
             notification.innerHTML = data.message + (errorMessages.length ? '<br>' + errorMessages.join(
               '<br>') : '');
             Swal.fire({
               title: data.message,
               icon: "warning",
               width: 800,
             });
           }
         },
         error: function(xhr) {
           var data = xhr.responseJSON || {
             status: false,
             message: 'Đã xảy ra lỗi.',
             errors: []
           };
           var notification = document.getElementById('notification');
           notification.style.display = 'block';
           notification.className = 'error';
           const errorMessages = data.errors && typeof data.errors === 'object' ?
             Object.values(data.errors).flat() :
             [data.message || 'Đã xảy ra lỗi.'];
           notification.innerHTML = data.message + (errorMessages.length ? '<br>' + errorMessages.join('<br>') :
             '');
         }
       })
     })
     $('body').delegate('.add_to_wishlist', 'click', function() {
       var product_id = $(this).attr('id')
       $.ajax({
         type: 'POST',
         url: '{{ route('front.add_to_wishlist') }}',
         data: {
           '_token': '{{ csrf_token() }}',
           product_id: product_id,
         },
         dataType: 'json',
         success: function(data) {
           if (data.is_wishlist == 0) $('.add_to_wishlist' + product_id).removeClass('btn-wishlist-add')
           else $('.add_to_wishlist' + product_id).addClass('btn-wishlist-add')
         },
         error: function(data) {}
       })
     })
   </script>
 </body>

 </html>
