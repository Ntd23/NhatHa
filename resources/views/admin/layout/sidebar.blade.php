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
        <li class="@if (Request::segment(2) === 'admin') active @endif">
          <a href="{{route('admin.index')}}"><i class="fa fa-bell-o"></i> <span>Quản trị viên</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'customer') active @endif">
          <a href="{{route('admin.customer')}}"><i class="fa fa-bell-o"></i> <span>Khách hàng</span></a>
        </li>
        <li class="@if (Request::segment(2) === 'slider') active @endif">
          <a href="{{route('admin.slider.index')}}"><i class="fa fa-bell-o"></i> <span>Thanh trượt</span></a>
        </li>
      </ul>
    </div>
  </div>
</div>
