<header class="header header-8">
  <div class="header-top">
    <div class="container">
      <div class="header-right">
        <ul class="top-menu">
          <li>
            <a href="#">Links</a>
            <ul>
              <li><a href="tel:{{ $getSystemSettingApp->phone }}"><i class="icon-phone"></i>Gọi:
                  {{ $getSystemSettingApp->phone }}</a></li>
              @if (!empty(Auth::check()))
                <li><a href="{{ route('front.my_wishlist') }}"><i class="icon-heart-o"></i>My Wishlist<span></span></a>
                </li>
              @else
                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-heart-o"></i>My Wishlist<span></span></a>
                </li>
              @endif
              <li><a href="{{ route('front.contact') }}">Liên hệ</a></li>
              @if (!empty(Auth::check()))
                <li><a href="{{ route('front.dashboard') }}">{{ Auth::user()->name }}</a></li>
              @else
                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="header-middle sticky-header">
    <div class="container">
      <div class="header-left">
        <button class="mobile-menu-toggler">
          <span class="sr-only">Toggle mobile menu</span>
          <i class="icon-bars"></i>
        </button>
        <a href="{{ route('front.home') }}" class="logo">
          <img src="{{ url($getSystemSettingApp->getLogo()) }}" alt="Molla Logo" style="width: 100px;height: auto;">
        </a>
      </div>

      <nav class="main-nav" style="margin-right: 20rem;">
        <ul class="menu sf-arrows ml-5">
          <li class="megamenu-container active">
            <a href="{{ route('front.home') }}"
              style="font-size: medium; font-weight: bolder; padding-top: 6.25rem; color: white;">Trang chủ</a>
          </li>
          <li style="padding-bottom: 25px;">
            @php
              $getCategoryHeader = \App\Models\Category::getRecordMenu();
            @endphp
            @foreach ($getCategoryHeader as $value_h_c)
              <div class="nav-item dropdown position-relative d-inline-block">
                <a href="{{ route('front.category', $value_h_c->slug) }}" class="nav-link px-3 text-uppercase"
                  style="padding-top: 6.25rem; font-weight: 700; font-size: medium; color: white;">
                  {{ $value_h_c->name }}
                </a>
                <div class="custom-dropdown position-absolute">
                  <ul class="list-unstyled">
                    @foreach ($value_h_c->getSubCategory() as $value_h_sub)
                      <li>
                        <a href="{{ route('front.category', [$value_h_c->slug, $value_h_sub->slug]) }}"
                          class="dropdown-item py-2 px-3">
                          {{ $value_h_sub->name }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endforeach
          </li>
          <li style="padding-bottom: 25px;">
            @php
              $pages = \App\Models\Page::getRecordExceptHome();
            @endphp
            <div class="nav-item dropdown position-relative d-inline-block">
              <a href="#" class="nav-link px-3 text-uppercase"
                style="padding-top: 6.25rem; font-weight: 700; font-size: medium; color: white;">
                Trang
              </a>
              <div class="custom-dropdown position-absolute">
                <ul class="list-unstyled">
                  @foreach ($pages as $page)
                    <li>
                      <a href="{{ url($page->slug) }}" class="dropdown-item py-2 px-3">
                        {{ $page->title }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>

      <div class="header-right">
        <div class="header-search">
          <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
          <form action="{{ route('front.search') }}" method="get">
            <div class="header-search-wrapper">
              <label for="q" class="sr-only">Search</label>
              <input type="search" class="form-control" name="q"
                value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" id="q"
                placeholder="Tìm kiếm..." required>
            </div>
          </form>
        </div>
        <div class="dropdown cart-dropdown" style="padding-top: 18px;">
          <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static" style="display: block !important; color: white;">
            <i class="icon-shopping-cart" style="position: absolute; top: -12px; right: 0;"></i>
            <span class="cart-count"
              style="position: absolute; top: -20px; right: -5px;">{{ Cart::getContent()->count() }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products">
              @foreach (Cart::getContent() as $header_cart)
                @php
                  $getCartProduct = App\Models\Product::getSingle($header_cart->id);
                @endphp
                @if (!empty($getCartProduct))
                  @php
                    $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                  @endphp
                  <div class="product">
                    <div class="product-cart-details">
                      <h4 class="product-title">
                        <a href="{{ $getCartProduct->slug }}">{{ $getCartProduct->title }}</a>
                      </h4>
                      <span class="cart-product-info">
                        <span class="cart-product-qty">{{ $header_cart->quantity }}</span>
                        x @money($header_cart->price)
                      </span>
                    </div>
                    <figure class="product-image-container">
                      <a href="{{ $getCartProduct->slug }}" class="product-image">
                        <img src="{{ $getProductImage->getLogo() }}" alt="product">
                      </a>
                    </figure>
                    <a href="{{ route('front.cart_delete', $header_cart->id) }}" class="btn-remove"
                      title="Xóa sản phẩm"><i class="icon-close"></i></a>
                  </div>
                @endif
              @endforeach
            </div>
            <div class="dropdown-cart-total">
              <span>Tổng</span>
              <span class="cart-total-price">@money(Cart::getSubTotal())</span>
            </div>
            <div class="dropdown-cart-action">
              <a href="{{ route('front.cart') }}" class="btn btn-primary">Xem giỏ hàng</a>
              <a href="{{ route('front.checkout') }}" class="btn btn-outline-primary-2"><span>Thanh toán</span><i
                  class="icon-long-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="alert alert-success position-fixed"
  style="top: 20px; right: -300px; width: 300px; transition: all 0.5s ease;" role="alert" id="messageAlert">
  @include('layout._message')
</div>
