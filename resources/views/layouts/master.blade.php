<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/icon.png')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @yield('css')
</head>
<body>

    <div class="header">
        <nav class="navbar navbar-expand-lg text-bg-nso bg-nso">
            <div class="container">
                <a class="navbar-brand logo" href="{{route('index')}}">NSO HỒI ỨC TGAME</a>
                    <div class="d-flex">
                        <a href="#" class="menu-toggle" id="open-menu-toggle"><i class="fa-solid fa-align-justify"></i></a>
                        <div class="mobile-menu" id="navbarText">
                            <a href="#" class="menu-toggle" id="close-menu-toggle"><i class="fa-solid fa-align-justify"></i></a>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('index.download')}}"><i class="fa-solid fa-download"></i> TẢI GAME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('index.news')}}"><i class="fas fa-bell"></i> TIN TỨC</a>
                                </li>
                                @if(!Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('index.login')}}"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP</a>
                                    </li>
									<li class="nav-item">
                                        <a class="nav-link" href="{{route('index.register')}}"><i class="fas fa-user-edit"></i> ĐĂNG KÝ</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('index.huongDan')}}"><i class="fas fa-book-open"></i> HƯỚNG DẪN NẠP TIỀN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('index.chucnang')}}"><i class="fas fa-bookmark"></i> CHỨC NĂNG</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i> TÀI KHOẢN
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><p class="dropdown-item"><i class="fas fa-coins"></i> Hồi Ức coin: <span style="color: red;">{{number_format(Auth::user()->coin)}}</span></p></li>
                                        <li><a class="dropdown-item" href="{{route('index.profile')}}"><i class="fa-solid fa-circle-info"></i> Thông tin tài khoản</a></li>
                                        <li><a class="dropdown-item" href="{{route('index.history')}}"><i class="fas fa-history"></i> Lịch sử giao dịch</a></li>
                                        <li><a class="dropdown-item" href="{{route('index.password')}}"><i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('auth.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="nav-mn">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('index.download')}}"><i class="fa-solid fa-download"></i> TẢI GAME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('index.news')}}"><i class="fas fa-bell"></i> TIN TỨC</a>
                                </li>
                                @if(!Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('index.login')}}"><i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP</a>
                                    </li>
									<li class="nav-item">
                                        <a class="nav-link" href="{{route('index.register')}}"><i class="fas fa-user-edit"></i> ĐĂNG KÝ</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('index.huongDan')}}"><i class="fas fa-book-open"></i> HƯỚNG DẪN NẠP TIỀN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{route('index.chucnang')}}"><i class="fas fa-bookmark"></i> CHỨC NĂNG</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i> TÀI KHOẢN
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><p class="dropdown-item"><i class="fas fa-coins"></i> Hồi Ức coin: <span style="color: red;">{{number_format(Auth::user()->coin)}}</span></p></li>
                                        <li><a class="dropdown-item" href="{{route('index.profile')}}"><i class="fa-solid fa-circle-info"></i> Thông tin tài khoản</a></li>
                                        <li><a class="dropdown-item " href="{{route('index.history')}}"><i class="fas fa-history"></i> Lịch sử giao dịch</a></li>
                                        <li><a class="dropdown-item" href="{{route('index.password')}}"><i class="fas fa-exchange-alt"></i> Đổi mật khẩu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{route('auth.logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                
              </div>
            </div>
          </nav>
    </div>

    <div class="main">
       @yield('content')
    </div>

    <div class="footer">
        <div class="container-fluid">
            <hr>
            <div class="footer-content">
                <p>Trò chơi không có bản quyền chính thức.</p>
                <p>Vui lòng cân nhắc kỹ trước khi tham gia.</p>
                <p>Chơi game quá 180 phút 1 ngày sẽ ảnh hướng xấu tới sức khoẻ</p>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('assets/js/main2.js')}}"></script>
    @yield('js')
</body>
</html>