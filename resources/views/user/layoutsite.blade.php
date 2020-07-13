<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>@yield('title')</title>


    <link rel="stylesheet" href="{{ asset('css/bs4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/layoutsite.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.css') }}">
    <style>
        .dropdown {
            position:static !important;
        }
        .dropdown-menu {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15)!important;
            margin-top:0px !important;
            width:100% !important;
        }
        .nav-item {
            margin: 0 10px;
        }
        .nav__name{
            font-weight: 600;
        }
        .title-brands{
            font-weight: 600;
            font-size: 1.1rem;
        }
        .title-product{
            position: relative;
            z-index: 2;
            color: #ffffff;
            padding: 0 20px;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .title-product::after{
            content: " ";
            display: block;
            border-top: 1px solid #0B0B0B;
            width: 30%;
            left: 0;
            height: 1px;
            position: absolute;
            top: 50%;
            z-index: 1;
        }
        .title-product::before{
            content: " ";
            display: block;
            border-top: 1px solid #0B0B0B;
            width: 30%;
            right: 0;
            height: 1px;
            position: absolute;
            top: 50%;
            z-index: 1;
        }
        .border-color{
            border: 1px solid #FF6600;
            border-radius: 10px;
        }
        .border-color:hover{

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .border-brands-product{
            border: 1px solid #0B0B0B;
            border-radius: 4%;
        }
        .border-color:hover{

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .margin-item {
            margin: 4px 4px;
        }
        .span-title{
            background-color: #ff6600; color: #ffffff; padding:3px 20px;
        }
        .span-title-brands
        {
             color: #333333;
        }
        footer{

            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            background-color: #efefef;
            text-align: center;
        }
        </style>
    @yield('head')
</head>
<body>
    <div class="container-fluid">
                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                        <a class="navbar-brand" href="#">WatchStore</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            {{-- Quản Lý Sản Phẩm --}}
                            <li class="nav-item dropdown">
                              <a class="nav-link nav__name dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Thương Hiệu
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <span class="text-uppercase">  Các Hãng  </span>
                                @foreach ($brandsproducts as $item)


                                <div class="row my-3">
                                    <div class="col-3">

                                        <a class="dropdown-item text-capitalize" href="#">
                                            <i class="fas fa-angle-double-right"></i> {{ $item->name }}
                                        </a>
                                    </div>
                                    <div class="col-3">
                                        <img src="{{ $item->image }}" class="d-none d-lg-block" style="height:3rem;width: 3rem" />
                                    </div>
                                    <div class="col-3"></div>
                                </div>


                                @endforeach
                              </div>

                            </li>
                            {{-- End Quản Lý Sản Phẩm --}}
                            {{-- /*  Quản Lí Loại */ --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav__name" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Loại Sản Phẩm
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <span class="text-uppercase">  Loại Sản Phẩm </span>
                                  @foreach ($categoryproducts as $item)


                                  <div class="row my-3">
                                      <div class="col-3">

                                          <a class="dropdown-item text-capitalize" href="{{ $item->slug }}">
                                              <i class="fas fa-angle-double-right"></i> {{ $item->name }}
                                          </a>
                                      </div>

                                  </div>


                                  @endforeach
                                </div>

                              </li>
                              {{--  Đối Tượng Quản Lý  --}}
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav__name" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Đối Tượng
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <span class="text-uppercase">  Đối Tượng</span>
                                  @foreach ($gendercategoryproducts as $item)


                                  <div class="row my-3">
                                      <div class="col-3">

                                          <a class="dropdown-item text-capitalize" href="{{ $item->slug }}">
                                              <i class="fas fa-angle-double-right"></i> {{ $item->name }}
                                          </a>
                                      </div>

                                  </div>
                                  @endforeach
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav__name" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Tin Tức
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <span class="text-uppercase">Chuyên Mục Tin Tức</span>
                                  @foreach ($topic as $item)


                                  <div class="row my-3">
                                      <div class="col-3">

                                          <a class="dropdown-item text-capitalize" href="{{ $item->slug }}">
                                              <i class="fas fa-angle-double-right"></i> {{ $item->name }}
                                          </a>
                                      </div>

                                  </div>


                                  @endforeach
                                </div>

                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav__name" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 Liên Hệ
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <span class="text-uppercase">Liên Hệ</span>



                                  <div class="row my-3">
                                      <div class="col-3">

                                          <a class="dropdown-item text-capitalize" href="">
                                              <i class="fas fa-angle-double-right"></i>thông tin liên hệ
                                          </a>
                                      </div>

                                  </div>
                                  <div class="row my-3">
                                    <div class="col-3">

                                        <a class="dropdown-item text-capitalize" href="">
                                            <i class="fas fa-angle-double-right"></i>thắc mắc góp ý
                                        </a>
                                    </div>

                                </div>



                                </div>

                              </li>
                          </ul>
                          <ul class="navbar-nav ml-md-auto account">

                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-users"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="#"><i class="fas fa-users"></i><span class="item-margin-5">Thông Tin</span></a>
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
                <footer class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            This footer will always be positioned at the bottom of the page,
                        </div>
                    </div>

                </footer>
    </div>





    <script src="{{asset('js/jquery/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="{{ asset('js/jquery/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bs4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/brands.js') }}"></script>
    <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/solid.js') }}"></script>




</body>

@yield('script')
</html>
