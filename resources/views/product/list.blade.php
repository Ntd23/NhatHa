@extends('app')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/plugins/nouislider/nouislider.css') }}">
@endsection

@section('content')
  <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        @if (!empty($getSubCategory))
          <h1 class="page-title">{{ $getSubCategory->name }}</h1>
        @elseif(!empty($getCategory))
          <h1 class="page-title">{{ $getCategory->name }}</h1>
        @else
          <h1 class="page-title">Tìm kiếm: {{ Request::get('q') }}</h1>
        @endif
      </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
          @if (!empty($getSubCategory))
            <li class="breadcrumb-item active" aria-current="page"><a
                href="{{ route('front.category', $getCategory->slug) }}">{{ $getCategory->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->name }}</li>
          @elseif(!empty($getCategory))
            <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->name }}</li>
          @endif
        </ol>
      </div>
    </nav>
    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="toolbox">
              <div class="toolbox-left">
                <div class="toolbox-info">
                  Hiển thị <span> {{ $getProduct->perPage() }}/{{ $getProduct->total() }}</span> sản phẩm
                </div>
              </div>
              <div class="toolbox-right">
                <div class="toolbox-sort">
                  <label for="sortby">Sắp xếp theo:</label>
                  <div class="select-custom">
                    <select name="sortby" id="sortby" class="form-control ChangeSortBy">
                      <option value="">Chọn</option>
                      <option value="popularity" selected="selected">Most Popular</option>
                      <option value="rating">Most Rated</option>
                      <option value="date">Date</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div id="getProductAjax">
              @include('product._list')
            </div>
            <div class="text-center">
              <a href="javascript:;" @empty($page) style="display: none;" @endempty
                class="btn btn-primary LoadMore" data-page="{{ $page }}">Xem thêm</a>
            </div>
          </div>
          <aside class="col-lg-3 order-lg-first">
            <form id="FilterForm" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="q" value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}">
              <input type="hidden" name="old_category_id" value="{{ !empty($getCategory) ? $getCategory->id : '' }}">
              <input type="hidden" name="old_sub_category_id"
                value="{{ !empty($getSubCategory) ? $getSubCategory->id : '' }}">
              <input type="hidden" name="sub_category_id" id="get_sub_category_id">
              <input type="hidden" name="brand_id" id="get_brand_id">
              <input type="hidden" name="size_id" id="get_size_id">
              <input type="hidden" name="start_price" id="get_start_price">
              <input type="hidden" name="end_price" id="get_end_price">
              <input type="hidden" name="sort_by_id" id="get_sort_by_id">
            </form>
            <div class="sidebar sidebar-shop">
              <div class="widget widget-clean">
                <label>Lọc sản phẩm:</label>
                <a href="" class="sidebar-filter-clear">Hủy bỏ</a>
              </div>
              @if (!empty($getSubCategoryFilter))
                <div class="widget widget-collapsible">
                  <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                      aria-controls="widget-1">
                      Danh mục
                    </a>
                  </h3>
                  <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                      <div class="filter-items filter-items-count">
                        @foreach ($getSubCategoryFilter as $f_category)
                          <div class="filter-item">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input ChangeCategory"
                                value="{{ $f_category->id }}" id="cat-{{ $f_category->id }}">
                              <label class="custom-control-label"
                                for="cat-{{ $f_category->id }}">{{ $f_category->name }}</label>
                            </div>
                            <span class="item-count">{{ $f_category->TotalProduct() }}</span>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              <div class="widget widget-collapsible">
                <h3 class="widget-title">
                  <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                    aria-controls="widget-2">
                    Kích cỡ
                  </a>
                </h3>

                <div class="collapse show" id="widget-2">
                  <div class="widget-body">
                    <div class="filter-items">
                      @foreach ($getSize as $f_size)
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input ChangeSize" value="{{ $f_size->id }}"
                              id="size-{{ $f_size->id }}">
                            <label class="custom-control-label"
                              for="size-{{ $f_size->id }}">{{ $f_size->name }}</label>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>

              <div class="widget widget-collapsible">
                <h3 class="widget-title">
                  <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                    aria-controls="widget-4">
                    Thương hiệu
                  </a>
                </h3>
                <div class="collapse show" id="widget-4">
                  <div class="widget-body">
                    <div class="filter-items">
                      @foreach ($getBrand as $f_brand)
                        <div class="filter-item">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input ChangeBrand"
                              value="{{ $f_brand->id }}" id="brand-{{ $f_brand->id }}">
                            <label class="custom-control-label"
                              for="brand-{{ $f_brand->id }}">{{ $f_brand->name }}</label>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="widget widget-collapsible">
                <h3 class="widget-title">
                  <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                    aria-controls="widget-5">
                    Giá tiền
                  </a>
                </h3>
                <div class="collapse show" id="widget-5">
                  <div class="widget-body">
                    <div class="filter-price">
                      <div class="filter-price-text">
                        <span id="filter-price-range"></span>
                      </div>
                      <div id="price-slider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('script')
  <script>
    $('.ChangeCategory').change(function() {
      let ids = '';
      $('.ChangeCategory').each(function() {
        if (this.checked) {
          let id = $(this).val()
          ids += id + ','
        }
      })
      $('#get_sub_category_id').val(ids)
      FilterForm()
    })
    $('.ChangeBrand').change(function() {
      let ids = '';
      $('.ChangeBrand').each(function() {
        if (this.checked) {
          let id = $(this).val()
          ids += id + ','
        }
      })
      $('#get_brand_id').val(ids)
      FilterForm()
    })
    $('.ChangeSize').change(function() {
      let ids = '';
      $('.ChangeSize').each(function() {
        if (this.checked) {
          let id = $(this).val()
          ids += id + ','
        }
      })
      $('#get_size_id').val(ids)
      FilterForm()
    })
		$('.ChangeSortBy').change(function() {
			let id= $(this).val()
			$('#get_sort_by_id').val(id)
			FilterForm()
		})
    //load more products
    $('body').delegate('.LoadMore', 'click', function() {
      let page = $(this).attr('data-page');
      $('.LoadMore').html('Vui lòng chờ trong giây lát...')
      if (xhr && xhr.readyState != 4) {
        xhr.abort()
      }
      xhr = $.ajax({
        type: 'POST',
        url: "{{ route('front.filter_product') }}?page=" + page,
        data: $('#FilterForm').serialize(),
        dataType: 'json',
        success: function(data) {
          $('#getProductAjax').append(data.success)
          $('.LoadMore').attr('data-page', data.page)
          if (data.page == 0) $('.LoadMore').hide()
          else $('.LoadMore').show()
        },
        error: function() {
          alert(1)
        }
      })
    })
    //slider filter price
    var i = 0;
    if (typeof noUiSlider === 'object') {
      var priceSlider = document.getElementById('price-slider');
      var mininit = 200000;
      var maxinit = 5000000;
      noUiSlider.create(priceSlider, {
        start: [mininit, maxinit],
        connect: true,
        step: 1,
        margin: 200,
        range: {
          'min': mininit,
          'max': maxinit
        },
        tooltips: true,
        format: wNumb({
          decimals: 0,
          thousand: ',',
          suffix: 'VND',
        })
      });
      priceSlider.noUiSlider.on('update', function(values, handle) {
        var start_price = values[0]
        var end_price = values[1]
        $('#get_start_price').val(start_price)
        $('#get_end_price').val(end_price)
        $('#filter-price-range').text(values.join(' - '));
        FilterForm()
        if (i == 0 || i == 1) {
          i++;
        } else {
          FilterForm()
        }
      });
    }
    var xhr;

    function FilterForm() {
      if (xhr && xhr.readyState != 4) {
        xhr.abort();
      }
      xhr = $.ajax({
        type: 'POST',
        url: "{{ route('front.filter_product') }}",
        data: $('#FilterForm').serialize(),
        dataType: 'json',
        success: function(data) {
          $('#getProductAjax').html(data.success)
          $('.LoadMore').attr('data-page', data.page)
          $('.LoadMore').html('Vui lòng chờ trong giây lát...')
          if (data.page == 0) $('.LoadMore').hide()
          else $('.LoadMore').show()
        },
        error: function() {

        }
      })
    }
  </script>
@endsection
