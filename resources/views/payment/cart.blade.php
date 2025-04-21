@extends('app')
@section('css')
@endsection
@section('content')
  <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        <h1 class="page-title">{{ $meta_title }}</h1>
      </div>
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $meta_title }}</li>
        </ol>
      </div>
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
      <div class="cart">
        <div class="container">
          @include('layout._message')
          @if (!empty(Cart::getContent()->count()))
            <div class="row">
              <div class="col-lg-9">
                <form action="{{ route('front.update_cart') }}" method="post">
                  {{ csrf_field() }}
                  <table class="table table-cart table-mobile">
                    <thead>
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach (Cart::getContent() as $key => $cart)
                        @php
                          $getCartProduct = App\Models\Product::getSingle($cart->id);
                        @endphp
                        @if (!empty($getCartProduct))
                          @php
                            $getProductImage = $getCartProduct->getImageSingle($getCartProduct->id);
                          @endphp
                          <tr>
                            <td class="product-col">
                              <div class="product">
                                <figure class="product-media">
                                  <a href="{{ $getCartProduct->slug }}">
                                    <img src="{{ $getProductImage->getLogo() }}" alt="{{ $getCartProduct->name }}">
                                  </a>
                                </figure>
                                <h3 class="product-title">
                                  <a href="{{ $getCartProduct->slug }}"
                                    class="mb-1 d-block">{{ $getCartProduct->title }}</a>
                                  @php
                                    $size_id = $cart->attributes->size_id;
                                  @endphp
                                  @if (!empty($size_id))
                                    @php
                                      $getSize = App\Models\ProductSize::getSingle($size_id);
                                    @endphp
                                    <div><b>Size:</b>{{ $getSize->name }} @money($getSize->price)</div>
                                  @endif
                                </h3>
                              </div>
                            </td>
                            <td class="price-col">@money($cart->price)</td>
                            <td class="quantity-col">
                              <div class="cart-product-quantity">
                                <input type="number" class="form-control" name="cart[{{ $key }}][qty]"
                                  value="{{ $cart->quantity }}" min="1" max="10" step="1"
                                  data-decimals="0" required>
                              </div>
                              <input type="hidden" value="{{ $cart->id }}" name="cart[{{ $key }}][id]">
                            </td>
                            <td class="total-col">@money($cart->price * $cart->quantity)</td>
                            <td class="remove-col"><a href="{{ route('front.cart_delete', $cart->id) }}"
                                class="btn-remove"><i class="icon-close"></i></a></td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-outline-dark-2 float-right">
									<span class="text-uppercase">cập nhật giỏ hàng</span><i class="icon-refresh"></i></button>
                </form>
              </div>
              <aside class="col-lg-3">
                <div class="summary summary-cart">
                  <h3 class="summary-title">Cần thanh toán:</h3>
                  <table class="table table-summary">
                    <tbody>
                      <tr class="summary-subtotal">
                        <td>Tổng:</td>
                        <td>@money(Cart::getSubTotal())</td>
                      </tr>
                    </tbody>
                  </table>
                  <a href="{{ route('front.checkout') }}"
                    class="btn btn-outline-primary-2 btn-order btn-block text-uppercase">xử lý thanh toán</a>
                </div>
                <a href="{{ route('front.home') }}"
                  class="btn btn-outline-dark-2 btn-block mb-3 text-uppercase"><span>tiếp tục mua hàng</span><i
                    class="icon-refresh"></i></a>
              </aside>
            </div>

        </div>
      @else
        <p>Không có sản phẩm nào trong giỏ hàng</p>
        @endif
      </div>
    </div>
    </div>
  </main>
@endsection
