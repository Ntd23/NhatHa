@extends('app')

@section('content')
  <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        <h1 class="page-title">{{ $getBlog->title }}</h1>
      </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{ route('front.blog') }}">Bài viết</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $getBlog->title }}</li>
        </ol>
      </div>
    </nav>
    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <article class="entry single-entry">
              <figure class="entry-media">
                <img src="{{ $getBlog->getImage() }}" alt="{{ $getBlog->title }}">
              </figure>

              <div class="entry-body">
                <div class="entry-meta">
                  <span class="meta-separator">|</span>
                  <a href="javascript:;">{{ date('M d, Y', strtotime($getBlog->created_at)) }}</a>
                  @if (!empty($getBlog->getCategory))
                    <span class="meta-separator">|</span>
                    <a
                      href="{{ route('front.blog_category', $getBlog->getCategory->slug) }}">{{ $getBlog->getCategory->name }}</a>
                  @endif
                </div>
                <div class="entry-content editor-content">{!! $getBlog->description !!}</div>
            </article><!-- End .entry -->

            <div class="related-posts">
              <h3 class="title">Bài viết liên quan</h3>

              <div class="owl-carousel owl-simple" data-toggle="owl"
                data-owl-options='{
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
                                            }
                                        }
                                    }'>
                @foreach ($getRelatedPost as $related)
                  <article class="entry entry-grid">
                    <figure class="entry-media">
                      <a href="{{ route('front.blog', $related->slug) }}">
                        <img src="{{ $related->getImage() }}" alt="{{ $related->title }}">
                      </a>
                    </figure>

                    <div class="entry-body">
                      <div class="entry-meta">
                        <a href="#">{{ date('M d, Y', strtotime($related->created_at)) }}</a>
                        <span class="meta-separator">|</span>
                        <a href="#">2 Comments</a>
                      </div>

                      <h2 class="entry-title">
                        <a href="{{ route('front.blog', $related->slug) }}">{{ $related->title }}</a>
                      </h2>
                      @if (!empty($related->getCategory))
                        <div class="entry-cats">
                          <a
                            href="{{ route('front.blog_category', $related->getCategory->slug) }}">{{ $related->getCategory->name }}</a>
                        </div>
                      @endif
                    </div>
                  </article>
                @endforeach
              </div>
            </div>

            <div class="comments">
              <h3 class="title">{{ $getBlog->getCommentCount() }} bình luận</h3>

              <ul>
                @foreach ($getBlog->getComment as $comment)
                  <li>
                    <div class="comment">
                      <div class="comment-body">
                        <div class="comment-user">
                          <div class="d-flex justify-center">
                            <h4>{{ $comment->getUser->name }}</h4>
                            <span class="comment-date ml-4">
                              {{ date('M d, Y', strtotime($comment->created_at)) }}
                              ,{{ date('h:i A', strtotime($comment->created_at)) }}
                            </span>
                          </div>
                        </div><!-- End .comment-user -->

                        <div class="comment-content">
                          <p>{{ $comment->comment }}</p>
                        </div><!-- End .comment-content -->
                      </div><!-- End .comment-body -->
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="reply">
              <div class="heading">
                <h3 class="title">Để lại bình luận</h3>
              </div><!-- End .heading -->

              <form action="{{ route('front.submit_comment') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="blog_id" value="{{ $getBlog->id }}">
                <label class="sr-only">Bình luận</label>
                <textarea name="comment"" cols="30" rows="4" class="form-control"></textarea>
                @if (!empty(Auth::check()))
                  <button type="submit" class="btn btn-outline-primary-2">
                    <span>GỬI</span>
                    <i class="icon-long-arrow-right"></i>
                  </button>
                @else
                  <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2">
                    <span>Gửi</span>
                    <i class="icon-long-arrow-right"></i>
                  </a>
                @endif
              </form>
            </div>
          </div>
          <aside class="col-lg-3">
            @include('blog.sidebar')
          </aside>
        </div>
      </div>
    </div>
  </main>
@endsection
