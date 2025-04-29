<div class="sidebar">
  <div class="widget widget-cats">
    <h3 class="widget-title">Danh mục</h3>
    <ul>
		@foreach ($getBlogCategory as $bc)
      <li><a href="{{route('front.blog_category',$bc->slug)}}">{{$bc->name}}<span>{{$bc->getCountBlog()}}</span></a></li>
		@endforeach
    </ul>
  </div>
  <div class="widget">
    <h3 class="widget-title">Phổ biến</h3>
    <ul class="posts-list">
      @foreach ($getPopular as $value)
        <li>
          <figure>
            <a href="{{ route('front.blog_detail', $value->slug) }}">
              <img src="{{ $value->getImage() }}" alt="{{ $value->title }}">
            </a>
          </figure>
          <div>
            <span>{{ date('M d, Y', strtotime($value->created_at)) }}</span>
            <h4><a href="{{ route('front.blog_detail', $value->slug) }}">{{ substr($value->title, 0, 15) . '...' }}</a>
            </h4>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>
