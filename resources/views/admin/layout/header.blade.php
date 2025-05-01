<div class="header">
  <div class="header-left">
    <a href="{{route('admin.dashboard')}}" class="logo">
      <img src="{{ url($getSettingHeader->getFavicon()) }}" width="35" height="35" alt="">
      <span>{{$getSettingHeader->website_name}}</span>
    </a>
  </div>
  <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
  <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
  <ul class="nav user-menu float-right">
	<li class="nav-item" style="width: 200px;">
		<a href="{{route('front.home')}}" class="d-md-inline-block d-none align-items-center text-center w-100 p-0">
			<span>XEM TRANG WEB</span><i class="fa fa-globe"></i>
		</a>
	</li>
    <li class="nav-item dropdown d-none d-sm-block">
      @php
        $getUnreadNotification = App\Models\Notification::getUnreadNotification();
      @endphp
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span
          class="badge badge-pill bg-danger float-right">{{ $getUnreadNotification->count() }}</span></a>
      <div class="dropdown-menu notifications">
        <div class="topnav-dropdown-header">
          <span>Thông báo</span>
        </div>
        <div class="drop-scroll">
          <ul class="notification-list">
            @foreach ($getUnreadNotification as $noti)
              <li class="notification-message">
                <a href="{{ $noti->url }}?noti_id={{ $noti->id }}">
                  <div class="media">
                    <div class="media-body">
                      <p class="noti-details">{{ $noti->message }}</p>
                      <p class="noti-time"><span
                          class="notification-time">{{ date('d-m-Y h:i:A', strtotime($noti->created_at)) }}</span></p>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="topnav-dropdown-footer">
          <a href="{{ route('admin.notification') }}">Tất cả thông báo</a>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown has-arrow">
      <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
        <span>{{Auth::user()->name}}</span>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ url('admin/logout') }}">Đăng xuất</a>
      </div>
    </li>
  </ul>
  <div class="dropdown mobile-user-menu float-right">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
        class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item" href="{{ url('admin/logout') }}">Đăng xuất</a>
    </div>
  </div>
</div>
