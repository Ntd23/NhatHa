@php
  $getSettingHeader = App\Models\SystemSetting::getSingle();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.layout.css')
</head>

<body>
  <div class="main-wrapper">
    @include('admin.layout.header')
		@yield('content')
    @include('admin.layout.sidebar')


  </div>
  <div class="sidebar-overlay" data-reff=""></div>
  @include('admin.layout.script')
	@yield('script')
</body>

</html>
