
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{!empty($meta_title) ? $meta_title : ''}}</title>
@if(!empty($meta_keywords))
<meta name="keywords" content="{{$meta_keywords}}">
@endif
@if(!empty($meta_description))
<meta name="description" content="{{$meta_description}}">
@endif
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{url($getSystemSettingApp->getFavicon())}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url($getSystemSettingApp->getFavicon())}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url($getSystemSettingApp->getFavicon())}}">
<link rel="manifest" href="{{url($getSystemSettingApp->getFavicon())}}">
<link rel="mask-icon" href="{{url($getSystemSettingApp->getFavicon())}}" color="#666666">
<link rel="shortcut icon" href="{{url($getSystemSettingApp->getFavicon())}}">
<meta name="apple-mobile-web-app-title" content="Molla">
<meta name="application-name" content="Molla">
<meta name="msapplication-TileColor" content="#cc9966">
<meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
<!-- Plugins CSS File -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/plugins/jquery.countdown.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/plugins/nouislider/nouislider.css')}}">
<!-- Main CSS File -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/skins/skin-demo-10.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/demos/demo-10.css')}}">

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

<style>
/* Header wrapper */
.header-custom {
  background: #000;
  padding: 20px 0;
  color: white;
  font-family: 'Arial', sans-serif;
}

/* Container Flex */
.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Logo */
.header-left .logo img {
  height: 35px;
}

/* Menu */
.main-nav .menu {
  display: flex;
  gap: 30px;
  list-style: none;
  margin: 0;
  padding: 0;
}

.menu li {
  position: relative;
}

.menu > li > a {
  color: white;
  font-weight: bold;
  text-decoration: none;
  padding: 8px 0;
  display: inline-block;
  transition: color 0.3s ease;
}

.menu > li > a:hover {
  color: #ffcc00;
}

/* Dropdown */
.nav-item.dropdown {
  position: relative;
}

.nav-item.dropdown:hover .custom-dropdown {
  display: block;
  opacity: 1;
  transform: translateY(0);
}

.custom-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background: #fff;
  width: 220px;
  border-radius: 6px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
  opacity: 0;
  transform: translateY(10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
  z-index: 1000;
}

.custom-dropdown .list-unstyled {
  margin: 0;
  padding: 0;
	border-radius: 6px;
  display: block; /* Đảm bảo ul hiển thị */
}

.custom-dropdown .dropdown-item {
  display: block;
  padding: 10px 20px;
  color: #333;
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  line-height: 1.5; /* Đảm bảo chiều cao dòng */
  transition: all 0.3s ease;
}

.custom-dropdown .dropdown-item:hover {
  background: #120f0f;
  color: #fff;
  padding-left: 25px;
}

/* Header Right */
.header-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.header-search form {
  display: flex;
  border: 1px solid #ccc;
  border-radius: 4px;
  overflow: hidden;
}

.header-search input {
  border: none;
  padding: 6px 10px;
  outline: none;
  font-size: 14px;
}

.header-search button {
  background: none;
  border: none;
  color: white;
  padding: 6px 10px;
  cursor: pointer;
}

.cart-icon {
  position: relative;
}

.cart-icon i {
  font-size: 20px;
  color: white;
}

.cart-count {
  position: absolute;
  top: -8px;
  right: -10px;
  background: red;
  color: white;
  font-size: 11px;
  padding: 2px 5px;
  border-radius: 50%;
}
</style>


