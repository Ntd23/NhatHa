<div class="mobile-menu-overlay"></div>
<div class="mobile-menu-container">
  <div class="mobile-menu-wrapper">
    <span class="mobile-menu-close"><i class="icon-close"></i></span>

    <form action="{{route('front.search')}}" method="get" class="mobile-search">
		{{csrf_field()}}
      <label for="mobile-search" class="sr-only">Search</label>
      <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..."
        required>
      <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
    </form>

    <nav class="mobile-nav">
      <ul class="mobile-menu">
        <li class="active">
          <a href="index.html">Home</a>
        </li>
        @php
          $getCategoryMobile = App\Models\Category::getRecordMenu();
        @endphp
        @foreach ($getCategoryMobile as $value_m_c)
          @if (!empty($value_m_c->getSubCategory()->count()))
            <li>
              <a href="{{route('front.category',$value_m_c->slug)}}">{{ $value_m_c->name }}</a>
              <ul>
                @foreach ($value_m_c->getSubCategory() as $value_m_sub)
                  <li><a href="{{route('front.category',[$value_m_c->slug, $value_m_sub->slug])}}">{{ $value_m_sub->name }}</a></li>
                @endforeach
              </ul>
            </li>
          @endif
        @endforeach
      </ul>
    </nav>
    <div class="social-icons">
      <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
      <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
    </div><!-- End .social-icons -->
  </div><!-- End .mobile-menu-wrapper -->
</div>
