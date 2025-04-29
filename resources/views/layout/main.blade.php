@extends('app')
@section('content')
  <main class="main ">
    <div class="container">
      <div class="intro-slider-container slider-container-ratio mb-2">
        <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
          data-owl-options='{"nav": false}'>
          @foreach ($getSlider as $slider)
            @if (!empty($slider->getImage()))
              <div class="intro-slide">
                <figure class="slide-image">
                  <picture>
                    <source media="(max-width: 480px)" srcset="{{ $slider->getImage() }}">
                    <img src="{{ $slider->getImage() }}" alt="{{ $slider->title }}">
                  </picture>
                </figure><!-- End .slide-image -->
                <div class="intro-content">
                  <h3 class="intro-subtitle">{!! $slider->title !!}</h3><!-- End .h3 intro-subtitle -->
                  @if (!empty($slider->button_name) && !empty($slider->button_link))
                    <a href="{{ $slider->button_link }}" class="btn btn-white-primary btn-round">
                      <span>{{ $slider->button_name }}</span>
                      <i class="icon-long-arrow-right"></i>
                    </a>
                  @endif
                </div>
              </div>
            @endif
          @endforeach

        </div><!-- End .intro-slider owl-carousel owl-simple -->
        <span class="slider-loader"></span><!-- End .slider-loader -->
      </div><!-- End .intro-slider-container -->
    </div>

    <div class="icon-boxes-container icon-boxes-separator bg-transparent">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
              <span class="icon-box-icon text-primary">
                <i class="icon-rocket"></i>
              </span>
              <div class="icon-box-content">
                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                <p>Orders $50 or more</p>
              </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
          </div><!-- End .col-sm-6 col-lg-3 -->

          <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
              <span class="icon-box-icon text-primary">
                <i class="icon-rotate-left"></i>
              </span>

              <div class="icon-box-content">
                <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                <p>Within 30 days</p>
              </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
          </div><!-- End .col-sm-6 col-lg-3 -->
          <div class="col-sm-6 col-lg-3">
            <div class="icon-box icon-box-side">
              <span class="icon-box-icon text-primary">
                <i class="icon-life-ring"></i>
              </span>

              <div class="icon-box-content">
                <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                <p>24/7 amazing services</p>
              </div><!-- End .icon-box-content -->
            </div><!-- End .icon-box -->
          </div><!-- End .col-sm-6 col-lg-3 -->
        </div><!-- End .row -->
      </div>
    </div><!-- End .icon-boxes-container -->

    {{-- banner category  --}}
    @if (!empty($getCategory->count()))
      <div class="container">
        <div class="row justify-content-center">
          @foreach ($getCategory as $category)
            @if (!empty($category->getImage()))
              <div class="col-sm-5 col-md-3">
                <div class="banner banner-cat">
                  <a href="{{ route('front.category', $category->slug) }}">
                    <img src="{{ $category->getImage() }}" alt="{{ $category->name }}">
                  </a>
                  <div class="banner-content banner-content-overlay text-center">
                    <h3 class="banner-title font-weight-normal"><a
                        href="{{ route('front.category', $category->slug) }}">{{ $category->name }}</a></h3>
                    <h4 class="banner-subtitle">{{ $category->getProduct()->count() }} sản phẩm</h4>
                    @if (!empty($category->button_name))
                      <a href="{{ route('front.category', $category->slug) }}"
                        class="banner-link">{{ $category->button_name }}</a>
                    @endif
                  </div><!-- End .banner-content -->
                </div><!-- End .banner -->
              </div>
            @endif
          @endforeach
        </div>
      </div>
    @endif
    <div class="mb-4"></div><!-- End .mb-4 -->
    <div class="container">
      <div class="heading heading-center mb-3">
        <h2 class="title-lg mb-2">Top Selling Products</h2><!-- End .title-lg text-center -->
        <ul class="nav nav-pills justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
              aria-controls="top-all-tab" aria-selected="true">All</a>
          </li>
          @foreach ($getCategory as $category)
            <li class="nav-item">
              <a class="nav-link getCategoryProduct" id="top-{{ $category->slug }}-link" data-toggle="tab"
                data-val="{{ $category->id }}" href="#top-{{ $category->slug }}-tab" role="tab"
                aria-controls="top-{{ $category->slug }}-tab" aria-selected="false">{{ $category->name }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
          <div class="products">
            @php
              $is_home = 1;
            @endphp
            @include('product._list')
          </div><!-- End .products -->
          <div class="more-container text-center mt-5">
            <a href="{{ route('front.search') }}" class="btn btn-outline-lightgray btn-more btn-round"><span>Xem
                thêm</span><i class="icon-long-arrow-right"></i></a>
          </div>
        </div>
        @foreach ($getCategory as $category)
          <div class="tab-pane p-0 fade getCategoryProduct{{ $category->id }}" id="top-{{ $category->slug }}-tab"
            role="tabpanel" aria-labelledby="top-{{ $category->slug }}-link">
          </div>
        @endforeach
      </div>
    </div>
    {{-- refund, payment delivery  --}}

    <div class="container">
      <hr>
      <div class="row justify-content-center">
        <div class="col-lg-4 col-sm-6">
          <div class="icon-box icon-box-card text-center">
            <span class="icon-box-icon">
              <img style="width: 50px;" src="" alt="">
            </span>
            <div class="icon-box-content">
              <h3 class="icon-box-title">dasdasd</h3>
              <p>fsefesf</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-5"></div><!-- End .mb5 -->
    @if (!empty($getBlog->count()))
      <div class="blog-posts">
        <div class="container">
          <h2 class="title-lg text-center mb-4">Bài viết từ chúng tôi</h2><!-- End .title-lg text-center -->

          <div class="owl-carousel owl-simple mb-4" data-toggle="owl"
            data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "520": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                }
                            }
                        }'>
            @foreach ($getBlog as $blog)
              <article class="entry">
                <figure class="entry-media">
                  <a href="{{ route('front.blog_detail', $blog->slug) }}">
                    <img src="{{ $blog->getImage() }}" alt="{{ $blog->title }}">
                  </a>
                </figure>
                <div class="entry-body text-center">
                  <div class="entry-meta">
                    <a href="#">{{ date('M d, Y', strtotime($blog->created_at)) }}</a>, 0 bình luận
                  </div>
                  <h3 class="entry-title">
                    <a href="{{ route('front.blog_detail', $blog->slug) }}">{{ $blog->title }}</a>
                  </h3>
                  <div class="entry-content">
                    <p>{!! substr($blog->short_description, 0, 25) . '...' !!}</p>
                    <a href="{{ route('front.blog_detail', $blog->slug) }}" class="read-more">Đọc thêm</a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
          <div class="more-container text-center mt-1">
            <a href="{{route('front.blog')}}" class="btn btn-outline-lightgray btn-more btn-round"><span>Xem thêm</span><i
                class="icon-long-arrow-right"></i></a>
          </div>
        </div>
      </div>
    @endif
  </main>
@endsection

@section('script')
  <script>
    $('body').delegate('.getCategoryProduct', 'click', function() {
      var category_id = $(this).attr('data-val')
      $.ajax({
        url: '{{ route('front.recent_arrival_category_product') }}',
        type: 'POST',
        data: {
          '_token': '{{ csrf_token() }}',
          category_id: category_id
        },
        dataType: 'json',
        success: function(response) {
          $('.getCategoryProduct' + category_id).html(response.success)
        }
      })
    })
  </script>
@endsection
