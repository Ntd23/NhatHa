<header class="header header-8">
  <div class="header-top">
    <div class="container">
      <div class="header-right">
        <ul class="top-menu">
          <li>
            <a href="#">Links</a>
            <ul>
              <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
              <li><a href="wishlist.html"><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              @if (!empty(Auth::check()))
                <li><a href="">{{ Auth::user()->name }}</a></li>
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

        <a href="index.html" class="logo">
          <img src="{{ asset('assets/images/demos/demo-10/logo.png') }}" alt="Molla Logo" width="105" height="25">
        </a>
      </div><!-- End .header-left -->

      <nav class="main-nav" style="margin-right: 20rem;">
        <ul class="menu sf-arrows">
          <li class="megamenu-container active">
            <a href="index.html" style="padding-top: 4.25rem;">Home</a>
          </li>
         <li style="padding-bottom: 25px;">
  @php
    $getCategoryHeader = \App\Models\Category::getRecordMenu();
  @endphp
  @foreach ($getCategoryHeader as $value_h_c)
    <div class="nav-item dropdown d-inline-block position-relative">
      <a href="{{ $value_h_c->slug }}" class="nav-link px-3 d-inline-block text-uppercase fw-bold"
         style="padding-top: 4.25rem;">{{ $value_h_c->name }}</a>
      <div class="megamenu position-absolute" style="display: none; z-index: 1000;width: max-content;height: 100%;">
        <div class="row g-0">
          <div class="menu-col px-0 py-0" style="margin-top: 0.2rem">
            <div class="row">
              <div class="col-md-12 pr-0">
                <ul class="list-unstyled">
                  @foreach ($value_h_c->getSubCategory() as $value_h_sub)
                    <li style="padding-right: 5px;"><a href="" class="dropdown-item py-1 font-weight-bold ml-2">{{ $value_h_sub->name }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</li>
        </ul>
      </nav>
      <div class="header-right">
        <div class="header-search">
          <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
          <form action="#" method="get">
            <div class="header-search-wrapper">
              <label for="q" class="sr-only">Search</label>
              <input type="search" class="form-control" name="q" id="q" placeholder="Search in..."
                required>
            </div><!-- End .header-search-wrapper -->
          </form>
        </div><!-- End .header-search -->
        <div class="dropdown cart-dropdown">
          <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" data-display="static">
            <i class="icon-shopping-cart"></i>
            <span class="cart-count">2</span>
          </a>

          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products">
              <div class="product">
                <div class="product-cart-details">
                  <h4 class="product-title">
                    <a href="product.html">Beige knitted elastic runner shoes</a>
                  </h4>

                  <span class="cart-product-info">
                    <span class="cart-product-qty">1</span>
                    x $84.00
                  </span>
                </div><!-- End .product-cart-details -->

                <figure class="product-image-container">
                  <a href="product.html" class="product-image">
                    <img src="assets/images/products/cart/product-1.jpg" alt="product">
                  </a>
                </figure>
                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
              </div><!-- End .product -->

              <div class="product">
                <div class="product-cart-details">
                  <h4 class="product-title">
                    <a href="product.html">Blue utility pinafore denim dress</a>
                  </h4>

                  <span class="cart-product-info">
                    <span class="cart-product-qty">1</span>
                    x $76.00
                  </span>
                </div><!-- End .product-cart-details -->

                <figure class="product-image-container">
                  <a href="product.html" class="product-image">
                    <img src="assets/images/products/cart/product-2.jpg" alt="product">
                  </a>
                </figure>
                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
              </div><!-- End .product -->
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
              <span>Total</span>

              <span class="cart-total-price">$160.00</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
              <a href="cart.html" class="btn btn-primary">View Cart</a>
              <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i
                  class="icon-long-arrow-right"></i></a>
            </div><!-- End .dropdown-cart-total -->
          </div><!-- End .dropdown-menu -->
        </div><!-- End .cart-dropdown -->
      </div>
    </div>
  </div>
</header>
