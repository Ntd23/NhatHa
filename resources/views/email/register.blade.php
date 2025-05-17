@component('mail::message')
  @php
    $getSetting = App\Models\SystemSetting::getSingle();
  @endphp
	Từ, {{$getSetting->website_name}}
  Xin chào, <b>{{ $user->name }}</b>
  <p>Click để kích hoạt tài khoản.</p>
  <p>
    @component('mail::button', ['url' => route('active_email',base64_encode($user->id))])
      Xác nhận
    @endcomponent
  </p>
@endcomponent
