<aside class="col-md-3 col-lg-2">
  <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) == 'dashboard') active @endif" href="{{ route('front.dashboard') }}">Bảng điều
        khiển</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) == 'order') active @endif"  href="{{ route('front.order') }}">Theo dõi đơn hàng</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) == 'edit-profile') active @endif" href="{{ route('front.edit_profile') }}">Hồ sơ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) == 'change-password') active @endif" href="{{ route('front.change_password') }}">Đổi mật khẩu</a>
    </li>
    <li class="nav-item">
		@php
			$getUnreadNotificationCount= App\Models\Notification::getUnreadNotificationCount(Auth::user()->id);
		@endphp
      <a class="nav-link @if (Request::segment(2) == 'notifications') active @endif" href="{{ route('front.notifications') }}">
			Thông báo <strong>({{$getUnreadNotificationCount}})</strong>
			</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('logout')}}">Đăng xuất</a>
    </li>
  </ul>
</aside>
