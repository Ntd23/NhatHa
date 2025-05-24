@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection
@section('content')
<main class="main">
	@include('layout._message')
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
				<li class="breadcrumb-item"><a
						href="{{ route('front.category', $getProduct?->getCategory?->slug) }}">{{ $getProduct?->getCategory?->name }}</a>
				</li>
				<li class="breadcrumb-item"><a
						href="{{ route('front.category', $getProduct?->getSubCategory?->slug) }}">{{ $getProduct?->getSubCategory?->name }}</a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }}</li>
			</ol>
		</div>
	</nav>
	<div class="page-content">
		<div class="container">
			<div class="product-details-top mb-2">
				<div class="row">
					<div class="col-md-6">
						<div class="product-gallery">
							<figure class="product-main-image">
								@php
								$getProductImage = $getProduct->getImageSingle($getProduct->id);
								@endphp
								@if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
								<img id="product-zoom" src="{{ $getProductImage->getLogo() }}"
									data-zoom-image="{{ $getProductImage->getLogo() }}" alt="product image">
								<a href="#" id="btn-product-gallery" class="btn-product-gallery">
									<i class="icon-arrows"></i>
								</a>
								@endif
							</figure>
							<div id="product-zoom-gallery" class="product-image-gallery">
								@foreach ($getProduct->getImage as $image)
								<a class="product-gallery-item" href="#" data-image="{{ $image->getLogo() }}"
									data-zoom-image="{{ $image->getLogo() }}">
									<img src="{{ $image->getLogo() }}">
								</a>
								@endforeach
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="product-details">
							<h1 class="product-title">{{ $getProduct->title }}</h1>
							<div class="ratings-container">
								<div class="ratings">
									<div class="ratings-val" style="width: {{$getProduct->getReviewRating($getProduct->id)}}%"></div>
								</div>
								<a class="ratings-text" href="#product-review-link" id="review-link">( {{$getProduct->getTotalReview()}}
									đánh giá )</a>
							</div>
							<div class="product-price">
								<span id="getTotalPrice">@money($getProduct->price)</span>
							</div>
							<div class="product-content">
								<p>{!! $getProduct->short_description !!}</p>
							</div>
							<form action="{{route('front.add_to_cart')}}" method="post">
								{{csrf_field()}}
								<input type="hidden" name="product_id" value="{{$getProduct->id}}">
								@if (!empty($getProduct->getSize->count()))
								<div class="details-filter-row details-row-size">
									<label for="size">Size:</label>
									<div class="select-custom">
										<select name="size_id" id="size_id" class="form-control getSizePrice">
											@foreach ($getProduct->getSize as $size)
											<option value="{{ $size->id }}" data-price="{{ !empty($size->price) ? $size->price : 0 }}">
												{{ $size->name }} -
												@if (!empty($size->price))
												@money($size->price)
												@endif
											</option>
											@endforeach
										</select>
									</div>
								</div>
								@endif
								<div class="details-filter-row details-row-size">
									<label for="qty">SL:</label>
									<div class="product-details-quantity">
										<input type="number" id="qty" name="qty" class="form-control" value="1" min="1" max="10" step="1"
											data-decimals="0" required>
									</div>
								</div>
								<div class="product-details-action">
									<button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>
									<div class="details-action-wrapper">
										@if(!empty(Auth::check()))
										<a href="javascript:;" id="{{$getProduct->id}}"
											class="btn-product btn-wishlist add_to_wishlist
										add_to_wishlist{{$getProduct->id}} {{ !empty($getProduct->checkWishList($getProduct->id)) ? 'btn-wishlist-add' : '' }}" title="Yêu thích"><span>Thêm vào
												yêu thích</span></a>
										@else
										<a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist"
											title="Yêu thích"><span>Thêm vào yêu
												thích</span></a>
										@endif
									</div>
								</div>
							</form>
							<div class="product-details-footer">
								<div class="product-cat">
									<span>Danh mục:</span>
									<a
										href="{{ route('front.category', $getProduct->getCategory->slug) }}">{{ $getProduct->getCategory->name }}</a>,
									<a
										href="{{ route('front.category', $getProduct->getSubCategory->slug) }}">{{ $getProduct->getSubCategory->name }}</a>,
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="product-details-tab product-details-extended">
			<div class="container">
				<ul class="nav nav-pills justify-content-center" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab"
							aria-controls="product-desc-tab" aria-selected="true">Mô tả</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab"
							aria-controls="product-info-tab" aria-selected="false">Thông tin bổ sung</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab"
							aria-controls="product-shipping-tab" aria-selected="false">Giao hàng & Trả hàng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab"
							aria-controls="product-review-tab" aria-selected="false">Đánh giá ({{$getProduct->getTotalReview()}})</a>
					</li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
					aria-labelledby="product-desc-link">
					<div class="product-desc-content">
						<div class="product-desc-row">
							<div class="container">
								{!! $getProduct->description !!}
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
					<div class="product-desc-content">
						<div class="product-desc-row">
							<div class="container">
								{!! $getProduct->additional_information !!}
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
					<div class="product-desc-content">
						<div class="container">
							{!! $getProduct->shipping_returns !!}
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
					<div class="reviews">
						<div class="container">
							<h3>Đánh giá ({{$getProduct->getTotalReview()}})</h3>
							<div class="review">
								<div class="row no-gutters">
									@foreach ($getReviewProduct as $review)
									<div class="col-auto">
										<h4><a href="#">{{$review->name}}</a></h4>
										<div class="ratings-container">
											<div class="ratings">
												<div class="ratings-val" style="width: {{$review->getPercent()}}%;"></div>
											</div>
										</div>
										<span class="review-date">{{Carbon\Carbon::parse($review->created_at)->diffForHumans()}}</span>
									</div>
									<div class="col">
										<h4>{{$review->review}}</h4>
									</div><!-- End .review-action -->
								</div><!-- End .col-auto -->
								@endforeach
								{!! $getReviewProduct->appends(Illuminate\Support\Facades\Request::except('pages'))->links() !!}
							</div>
						</div><!-- End .review -->
					</div>
				</div><!-- End .reviews -->
			</div>
		</div><!-- End .tab-content -->
	</div><!-- End .product-details-tab -->

	<div class="container">
		<h2 class="title text-center mb-4">Có thể bạn quan tâm</h2><!-- End .title text-center -->
		<div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
			{{-- Product related --}}
			@foreach ($getRelatedProduct as $value)
			<div class="product product-{{ $value->id }}">
				<figure class="product-media">
					<a href="{{ route('front.category', $value->slug) }}">
						@if (!empty($getProductImage) && !empty($getProductImage->getLogo()))
						<img src="{{ $getProductImage->getLogo() }}" alt="{{ $value->title }}" class="product-image">
						@endif
					</a>
					<div class="product-action-vertical">
						@if(!empty(Auth::check()))
						<a href="javascript:;" id="{{$getProduct->id}}"
							class="btn-product btn-wishlist add_to_wishlist
										add_to_wishlist{{$getProduct->id}} {{ !empty($getProduct->checkWishList($getProduct->id)) ? 'btn-wishlist-add' : '' }}" title="Yêu thích"><span>Thêm vào
								yêu thích</span></a>
						@else
						<a href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Yêu thích"><span>Thêm
								vào yêu
								thích</span></a>
						@endif
					</div>
					{{-- <div class="product-action">
						<a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
					</div> --}}
				</figure>
				<div class="product-body">
					<div class="product-cat">
						<a
							href="{{ route('front.category', $value->category_slug, $value->sub_category_slug) }}">{{ $value->sub_category_name }}</a>
					</div>
					<h3 class="product-title"><a href="{{ route('front.category', $value->slug) }}">{{ $value->title }}</a>
					</h3>
					<div class="product-price">@money($value->price)</div>
					<div class="ratings-container">
						<div class="ratings">
							<div class="ratings-val" style="width: {{$value->getReviewRating($value->id)}}%"></div>
						</div>
						<span class="ratings-text">( {{$value->getTotalReview()}} đánh giá )</span>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	</div>
</main>
@endsection

@section('script')
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script>
	$('.getSizePrice').change(function() {
		var product_price = '{{ $getProduct->price }}'
		var price = $('option:selected', this).attr('data-price')
		var total = parseFloat(product_price) - parseFloat(price) + parseFloat(price)
		$('#getTotalPrice').html(new Intl.NumberFormat('en-US').format(total) + ' VND')
	})
</script>
@endsection
