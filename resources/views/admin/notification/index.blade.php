@extends('admin.layout.app')
@section('content')
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-sm-9">
          <h4 class="page-title">{{ $header_title }}</h4>
        </div>
      </div>
      @include('admin.layout.message')
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <tbody>
                @foreach ($getRecord as $value)
                  <tr>
                    <td>
                      <a href="{{ route('front.category', $item->getProduct->slug) }}" style="color: #000;">
                      </a>
                      <div><small>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</small></div>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
            <div style="padding: 10px; float: right;">
              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('pages'))->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section('script')
    <script></script>
  @endsection
