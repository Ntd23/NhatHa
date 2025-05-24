<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
  <li class="@if (Request::segment(2) === 'dashboard') active @endif">
    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer"></i> <span>Bảng điều khiển</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'category') active @endif">
    <a href="{{ route('admin.category.index') }}"><i class="fa fa-list"></i> <span>Danh mục</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'subcategory') active @endif">
    <a href="{{ route('admin.subcategory.index') }}"><i class="fa fa-indent"></i> <span>Danh mục con</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'product') active @endif">
    <a href="{{ route('admin.product.index') }}"><i class="fa fa-cube"></i> <span>Sản phẩm</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'blog-category') active @endif">
    <a href="{{ route('admin.blog_category.index') }}"><i class="fa fa-folder-open"></i> <span>Danh mục bài viết</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'blog') active @endif">
    <a href="{{ route('admin.blog.index') }}"><i class="fa fa-pencil-square-o"></i> <span>Bài viết</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'brand') active @endif">
    <a href="{{ route('admin.brand.index') }}"><i class="fa fa-tags"></i> <span>Thương hiệu</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'discountcode') active @endif">
    <a href="{{ route('admin.discountcode.index') }}"><i class="fa fa-ticket"></i> <span>Mã giảm giá</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'shipping-charge') active @endif">
    <a href="{{ route('admin.shippingcharge.index') }}"><i class="fa fa-truck"></i> <span>Phí giao hàng</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'order') active @endif">
    <a href="{{ route('admin.order.index') }}"><i class="fa fa-shopping-cart"></i> <span>Đặt hàng</span></a>
  </li>
	 <li class="menu-title">Người dùng</li>
  <li class="@if (Request::segment(2) === 'admin') active @endif">
    <a href="{{ route('admin.index') }}"><i class="fa fa-user"></i> <span>Quản trị viên</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'customer') active @endif">
    <a href="{{ route('admin.customer') }}"><i class="fa fa-users"></i> <span>Khách hàng</span></a>
  </li>
  <li class="@if (Request::segment(2) === 'contact') active @endif">
    <a href="{{ route('admin.contact') }}"><i class="fa fa-envelope"></i> <span>Liên hệ</span></a>
  </li>
  <li class="menu-title">Cài đặt</li>
  <li class="submenu">
    <a href="#"><i class="fa fa-cogs"></i><span>Cài đặt</span> <span class="menu-arrow"></span></a>
    <ul style="display: none;">
      <li class="@if (Request::segment(2) === 'slider') active @endif">
        <a href="{{ route('admin.slider.index') }}"><i class="fa fa-sliders"></i> <span>Thanh trượt</span></a>
      </li>
      <li class="@if (Request::segment(2) === 'payment-setting') active @endif">
        <a href="{{ route('admin.payment_setting') }}"><i class="fa fa-credit-card"></i> <span>Thanh toán</span></a>
      </li>
      <li class="@if (Request::segment(2) === 'smtp-setting') active @endif">
        <a href="{{ route('admin.smtp_setting') }}"><i class="fa fa-credit-card"></i> <span>SMTP</span></a>
      </li>
      <li class="@if (Request::segment(2) === 'page') active @endif">
        <a href="{{ route('admin.page.index') }}"><i class="fa fa-file-text-o"></i> <span>Trang</span></a>
      </li>
      <li class="@if (Request::segment(2) === 'home-setting') active @endif">
        <a href="{{ route('admin.home_setting') }}"><i class="fa fa-home"></i> <span>Trang chủ</span></a>
      </li>
      <li class="@if (Request::segment(2) === 'system-setting') active @endif">
        <a href="{{ route('admin.system_setting') }}"><i class="fa fa-wrench"></i> <span>Chung</span></a>
      </li>
    </ul>
  </li>
</ul>

    </div>
  </div>
</div>
