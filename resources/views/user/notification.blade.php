@extends('app')
@section('style')
@endsection
@section('content')
  <main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
      <div class="container">
        <h1 class="page-title">Thông báo</h1>
      </div>
    </div>
    <div class="page-content">
      <div class="dashboard">
        <div class="container">
          <hr>
          <hr>
          <div class="row">
            @include('user._sidebar')
            <div class="col-md-9 col-lg-10">
              <div class="tab-content">
                <table class="table table-striped">
                  <tbody>
                    @foreach ($getRecord as $value)
                      <tr>
                        <td class="p-3">
                          <a href="{{ $value->url }}?noti_id={{ $value->id }}"
                            style="color: #000; {{ empty($value->is_read) ? 'font-weight:bold' : '' }}">
                            {{ $value->message }}
                          </a>
                          <div><small>
                              {{ date('d-m-Y h:i A', strtotime($value->created_at)) }}
                            </small></div>
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
      </div>
    </div>
  </main>
@endsection

@section('script')
@endsection
