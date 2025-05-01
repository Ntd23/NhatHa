<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="shortcut icon" type="image/x-icon" href="{{ url($getSettingHeader->getFavicon()) }}">
<title>{{ !empty($header_title) ? $header_title : '' }}</title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/style.css') }}">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
{{--
<script src="{{ asset('admin/assets/js/html5shiv.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/respond.min.js') }}"></script> --}}
<style>
	/* header */
  .header {
    background: linear-gradient(135deg, #ffeb3b, #ffca28);
    /* Gradient vàng sáng, đồng bộ với widget */
    border-bottom: 1px solid #ddd;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .header-left .logo span {
    color: #333;
    /* Chữ tên website màu tối để nổi bật */
    font-weight: 600;
  }

  .header .nav-link {
    color: #333;
    /* Màu chữ của các liên kết */
  }

  .header .nav-link:hover {
    color: #e91e63;
    /* Màu hồng đậm khi hover */
  }

  .header .user-menu .dropdown-toggle::after {
    border-top-color: #333;
    /* Mũi tên dropdown */
  }

  .header .badge.bg-danger {
    background-color: #e91e63 !important;
    /* Màu hồng đậm cho badge thông báo */
  }

  .header .mobile_btn,
  .header #toggle_btn {
    color: #333;
    /* Màu icon menu */
  }

  .header .mobile_btn:hover,
  .header #toggle_btn:hover {
    color: #e91e63;
    /* Màu hồng đậm khi hover */
  }

  .dropdown-menu {
    background-color: #fff;
    /* Nền dropdown trắng */
    border: 1px solid #ddd;
  }

  .dropdown-menu .dropdown-item {
    color: #333;
    /* Chữ trong dropdown */
  }

  .dropdown-menu .dropdown-item:hover {
    background-color: #ffca28;
    /* Màu vàng sáng khi hover */
    color: #333;
  }

  .notifications .topnav-dropdown-header,
  .notifications .topnav-dropdown-footer {
    background-color: #f5f5f5;
    /* Nền sáng cho header/footer của thông báo */
    color: #333;
  }

  .notification-list .notification-message .media-body p {
    color: #333;
    /* Chữ thông báo */
  }

  .notification-list .notification-message:hover {
    background-color: #ffca28;
    /* Màu vàng sáng khi hover thông báo */
  }
	 /* end header */
	 /* Sidebar chính */
.sidebar {
  background-color:rgb(66, 93, 119);
  color: white;
}

.sidebar-menu ul li a {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  border-radius: 10px;
  color: #333;
  transition: all 0.3s ease;
}

.sidebar-menu ul li a:hover {
  background-color: #e6fffa; /* xanh mint nhạt */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
  color: #009688;
}

.sidebar-menu ul li a i {
  margin-right: 10px;
  transition: transform 0.3s ease;
}

.sidebar-menu ul li.active a i {
  animation: icon-pulse 1s infinite alternate;
  color: #009688;
}

.sidebar-menu ul li.active > a {
  background-color: #ccf2ef;
  color: #009688;
  box-shadow: 0 2px 12px rgba(0, 150, 136, 0.2);
}

@keyframes icon-pulse {
  0% { transform: scale(1); }
  100% { transform: scale(1.1) rotate(1deg); }
}

</style>
@yield('css')


