<div class="products">
@php
	$is_home=1;
@endphp
@include('product._list')
</div>
<div class="more-container text-center mt-1">
  <a href="{{ route('front.category', $getCategory->slug) }}"
    class="btn btn-outline-lightgray btn-more btn-round"><span>Xem thêm</span><i
      class="icon-long-arrow-right"></i></a>
</div>
