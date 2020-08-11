<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bs4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/layoutsite.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('jtable/jquery.dataTables.min.css') }}">

        {{--  //aleartifyjs  --}}
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
      <!-- Semantic UI theme -->
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
      <!-- Bootstrap theme -->
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


    <style>
        html{
            font-size: 14px;
            line-height: 1.6rem;
            font-family: 'Roboto', sans-serif;

        }
        body{
            background-color: #F7F7F7;
        }
        #loading {
            background-color:white;
            position: fixed;
            display: block;
            top: 0;
            bottom: 0;
            z-index: 1000000;
            opacity: 0.5;
            width: 100%;
            height: 100%;
            text-align: center;
          }

          #loading img {
            margin: auto;
            display: block;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translateX(-50%) translateY(-50%);
            position: absolute;
            z-index: 999;
          }
          .btn{
              border-radius: 20px;
          }
    </style>
    @yield('head')
</head>
<body>
    <div class="app container-fluid">
                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item active">
                              <a class="nav-link" href="{{ Route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                            </li>
                            {{-- Quản Lý Sản Phẩm --}}
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Quản Lý Sản Phẩm
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ Route('productindex') }}">Danh Sách Sản Phẩm</a>
                                <a class="dropdown-item" href="{{ Route('getSaveProducts') }}">Thêm Sản Phẩm</a>
                                <a class="dropdown-item" href="{{ Route('view_product_quantity') }}">Thêm Số Lượng Sản Phẩm</a>
                              </div>
                            </li>
                            {{-- End Quản Lý Sản Phẩm --}}
                            {{-- /*  Quản Lí Loại */ --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Quản Lý Thuộc Tính
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('indexbrandproduct') }}">Quản Lý Hãng</a>
                                  <a class="dropdown-item" href="{{ Route('indexcategoryproducts') }}">Quản Lý Loại Đồng Hồ</a>
                                  <a class="dropdown-item" href="{{ Route('indexgendercategoryproducts') }}">Quản Lý Đối Tượng</a>

                                </div>
                              </li>
                         {{-- =
                            /*end Loại */ --}}
                            {{-- Quản Lý Đơn Hàng  --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Quản Lý Đơn Hàng
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('orders') }}">Danh Sách Đơn Hàng</a>
                                  <a class="dropdown-item" href="{{ Route('view_exportorders') }}">Danh Sách Hóa Đơn </a>

                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Quản Lý Bình Luận
                                  </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('orders') }}">Quản Lý Bình Luận</a>
                                </div>

                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Quản Lý Khách Hàng
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('users.view') }}">Danh Sách Khách Hàng</a>


                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Quản Lý Tin Tức
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('index.Topic') }}">Quản Lý Chủ Đề Tin Tức</a>
                                  <a class="dropdown-item" href="{{ Route('index.post') }}">Quản Lý Bài Viết</a>
                                </div>
                              </li>
                            {{-- End Quản Lý Đơn Hàng --}}
                          </ul>
                          <ul class="navbar-nav ml-auto account">

                              <li class="nav-item dropdown" style="width: 300px;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-users"></i> {{ Auth::guard('admin')->user()->fullname }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="#"><i class="fas fa-users"></i><span class="item-margin-5">Thông Tin</span></a>
                                  @if (Auth::guard('admin')->user()->access ==1 )

                                  <a class="dropdown-item" href="{{ Route('admin.index') }}"><i class="fas fa-users"></i><span class="item-margin-5">Quản Lý Nhân Viên</span></a>

                                  @endif
                                  <a class="dropdown-item" href="#"><i class="fas fa-cogs "></i><span class="item-margin-5">Setting</span></a>
                                  <a class="dropdown-item" href="{{ Route('logOutAdmin') }}"><i class="fas fa-sign-out-alt"></i><span class="item-margin-5">Đăng Xuất</span></a>
                                </div>
                              </li>

                          </ul>
                        </div>
                      </nav>
                </header>
                <main class="page-wrapper">
                  @yield('main')
                </main>
    </div>




 @includeIf('user.layout.loading.loading')

@includeIf('admin.public.js.scripts')

</body>

    <script>

        $(document).ready(function(){
            $(document).ajaxStart(function() {
                $("#loading").show();
            });
            $(document).ajaxStop(function() {
                $("#loading").hide();
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
@yield('script')
</html>
