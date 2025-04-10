<div class="products mb-3">
  <div class="row justify-content-start">
    @foreach ($getProduct as $value)
      @php
        $getProductImage = $value->getImageSingle($value->id);
      @endphp
      <div class="col-6 @if (!empty($is_home)) col-md-3 col-lg-3 @else col-md-4 col-lg-4 @endif">
        <div class="product product-7 text-center">
          <figure class="product-media">
            <a href="{{ route('front.category', $value->slug) }}">
              @if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
                <img src="{{ asset($getProductImage->getLogo()) }}" style="width: 100%;" alt="{{ $value->title }}"
                  class="product-image">
              @endif
            </a>
            <div class="product-action-vertical">
              <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>Thêm vào yêu thích</span></a>
            </div>
            <div class="product-action">
              <a href="#" class="btn-product btn-cart"><span>Thêm giỏ hàng</span></a>
            </div>
          </figure>
          <div class="product-body">
            <div class="product-cat">
              <a
                href="{{ route('front.category', $value->category_slug, $value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
            </div>
            <h3 class="product-title"><a href="{{ route('front.category', $value->slug) }}">{{ $value->title }}</a></h3>
            <div class="product-price">
              @money($value->price)
            </div>
            <div class="ratings-container">
              <div class="ratings">
                <div class="ratings-val" style="width: 20%;"></div>
              </div>
              <span class="ratings-text">( 2 Reviews )</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
