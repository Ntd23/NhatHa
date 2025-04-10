<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="@if (Request::segment(2) === 'dashboard') active @endif">
          <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'category') active @endif">
          <a href="{{ route('admin.category.index') }}"><i class="fa fa-user-md"></i> <span>Danh mục</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'subcategory') active @endif">
          <a href="{{route('admin.subcategory.index')}}"><i class="fa fa-comments"></i> <span>Danh mục con</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'product') active @endif">
          <a href="{{route('admin.product.index')}}"><i class="fa fa-cube"></i> <span>Sản phẩm</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'brand') active @endif">
          <a href="{{route('admin.brand.index')}}"><i class="fa fa-cube"></i> <span>Thương hiệu</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'discountcode') active @endif">
          <a href="{{route('admin.discountcode.index')}}"><i class="fa fa-bell-o"></i> <span>Mã giảm giá</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'shipping-charge') active @endif">
          <a href="{{route('admin.shippingcharge.index')}}"><i class="fa fa-bell-o"></i> <span>Phí giao hàng</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'order') active @endif">
          <a href="{{route('admin.order.index')}}"><i class="fa fa-bell-o"></i> <span>Đặt hàng</span></a>
        </li>
        <li class="menu-title">Cài đặt</li>
        <li class="submenu">
          <a href="#"><i class="fa fa-laptop"></i><span>Cài đặt</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a href="{{route('admin.payment_setting')}}">Thanh toán</a></li>
            <li><a href="typography.html">Typography</a></li>
            <li><a href="tabs.html">Tabs</a></li>
          </ul>
        </li>
        <li class="menu-title">Extras</li>
        <li class="submenu">
          <a href="#"><i class="fa fa-columns"></i> <span>Pages</span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a href="login.html"> Login </a></li>
            <li><a href="register.html"> Register </a></li>
            <li><a href="forgot-password.html"> Forgot Password </a></li>
            <li><a href="change-password2.html"> Change Password </a></li>
            <li><a href="lock-screen.html"> Lock Screen </a></li>
            <li><a href="profile.html"> Profile </a></li>
            <li><a href="gallery.html"> Gallery </a></li>
            <li><a href="error-404.html">404 Error </a></li>
            <li><a href="error-500.html">500 Error </a></li>
            <li><a href="blank-page.html"> Blank Page </a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="javascript:void(0);"><i class="fa fa-share-alt"></i> <span>Multi Level</span> <span
              class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li class="submenu">
              <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
              <ul style="display: none;">
                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                <li class="submenu">
                  <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                  <ul style="display: none;">
                    <li><a href="javascript:void(0);">Level 3</a></li>
                    <li><a href="javascript:void(0);">Level 3</a></li>
                  </ul>
                </li>
                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:void(0);"><span>Level 1</span></a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
