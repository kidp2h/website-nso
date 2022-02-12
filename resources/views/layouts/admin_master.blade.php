<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Trang quản trị NSO Hồi Ức Tgame</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/typicons/typicons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css ">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css ">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/admin/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="#" />
  @yield('css')
</head>
<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{route('admin.index')}}">
            <img src="{{asset('assets/admin/images/auth/logo.png')}}" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{route('admin.index')}}">
            <img src="{{asset('assets/admin/images/auth/logo.png')}}" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Quản trị <span class="text-black fw-bold">NSO Hồi Ức</span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{asset('assets/admin/images/auth/admin.png')}}" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{asset('assets/admin/images/auth/admin.png')}}" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">Admin</p>
              </div>
              <a class="dropdown-item" href="{{route('auth.logout')}}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Đăng xuất</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.index')}}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Trang chính</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.user')}}">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Tài khoản</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.history')}}">
              <i class="mdi mdi-key-minus menu-icon"></i>
              <span class="menu-title">Thống kê lịch sử giao dịch</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.giftcode')}}">
              <i class="mdi mdi-gift menu-icon"></i>
              <span class="menu-title">Quản lý Gift Code</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.upload')}}">
              <i class="mdi mdi-file-cloud menu-icon"></i>
              <span class="menu-title">Quản lý File Upload</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.webshop')}}">
              <i class="mdi mdi-shopping menu-icon"></i>
              <span class="menu-title">Quản lý Webshop</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.news')}}">
              <i class="mdi mdi-newspaper menu-icon"></i>
              <span class="menu-title">Quản lý tin tức</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.huongDan')}}">
              <i class="mdi mdi-note-text menu-icon"></i>
              <span class="menu-title">Hướng dẫn nạp tiền</span>
            </a>
          </li>
          <li class="nav-item nav-category">Website</li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('index')}}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Website</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        
        @yield('content')

      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('assets/admin/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('assets/admin/vendors/progressbar.js/progressbar.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/admin/js/template.js')}}"></script>
  <script src="{{asset('assets/admin/js/settings.js')}}"></script>
  <script src="{{asset('assets/admin/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
  <script src="{{asset('assets/admin/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->
  
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

  <script src="{{asset('assets/js/app2.js')}}"></script>


  @yield('js')
</body>

</html>

