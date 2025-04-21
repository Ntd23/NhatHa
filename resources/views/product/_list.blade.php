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
            	@if(!empty(Auth::check()))
						<a href="javascript:;" id="{{$value->id}}"
							class="btn-product btn-wishlist add_to_wishlist
										add_to_wishlist{{$value->id}} {{ !empty($value->checkWishList($value->id)) ? 'btn-wishlist-add' : '' }}" title="Yêu thích"><span>Thêm vào
								yêu thích</span></a>
						@else
						<a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Yêu thích"><span>Thêm
								vào yêu
								thích</span></a>
						@endif
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
                <div class="ratings-val" style="width: {{$value->getReviewRating($value->id)}}%;"></div>
              </div>
              <span class="ratings-text">( {{$value->getTotalReview()}} đánh giá )</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
