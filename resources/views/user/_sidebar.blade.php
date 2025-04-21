<aside class="col-md-3 col-lg-2">
  <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
    <li class="nav-item">
      <a class="nav-link @if (Request::segment(2) == 'dashboard') active @endif" href="{{ route('front.dashboard') }}">Bảng điều
        khiển</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" @if (Request::segment(2) == 'order') active @endif" href="{{ route('front.order') }}">Theo dõi đơn hàng</a>
    </li>
    <li class="nav-item">
      <a class="nav-link">Downloads</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"Adresses</a>
    </li>
    <li class="nav-item">
      <a class="nav-link">Account Details</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Sign Out</a>
    </li>
  </ul>
</aside>
