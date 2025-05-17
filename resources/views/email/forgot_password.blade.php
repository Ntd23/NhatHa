@component('mail::message')
@php
    $getSetting = App\Models\SystemSetting::getSingle();
  @endphp
  Từ, {{ $getSetting->website_name }}
  Xin chào <b>{{ $user->name }}</b>
  <p>We understand it happend</p>
  <p>
    @component('mail::button', ['url' => route('reset_password',$user->remember_token)])
      Khôi phục mật khẩu
    @endcomponent
  </p>
  <p>Nếu gặp vấn đề, hãy liên hệ ngay cho chúng tôi.</p>
@endcomponent
