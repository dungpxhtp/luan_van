<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @yield('meta')
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="shortcut icon" type="image/png" href="{{ asset('image/icon.png') }}">

    <link rel="stylesheet" href="{{ asset('css/bs4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/layoutsite.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/solid.css') }}">
    @yield('style')
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

            position: relative;
            background: #333333;
            height: 150px;
            clear:both;
            padding-top:20px;

            z-index: 50;
        }
        .title-product-detail{
               font-weight: 500;
            font-size: 1rem;
        }
        .sku_wrapper{
            display:block;
            clear:both;
            color:#000000;
            margin-bottom:10px;

        }
        .sku{
            color:#827c7c;
        }
        .price-product{
            font-size:1.4rem;
            color:#827c7c;
        }
        .add-cart
        {
            padding:10px;
            background: #990000;

        }
        .hvr-grow {
            display: inline-block;
            vertical-align: middle;
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            transition-duration: 0.3s;
            transition-property: transform;
        }

        .hvr-grow:hover,
        .hvr-grow:focus,
        .hvr-grow:active {
            transform: scale(1.1);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }
        .hotline{
            display:block;
        }
        .border-title-top-bottom{
            padding:20px 0;
            border-top: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
        }
        .description{
            margin : 5px 0;
            clear:both;
            text-align: justify;
        }
        .title-description:nth-child(even)
        {
            background-color: #EFEFF1;
        }
        .text-guarantee{
            font-weight: 700;
        }
        .reply-comment{
            margin: 5px 20px;
            background-color: #F1F1F1;
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
          .page-wrapper{
              min-height: 80vh;
          }
          .box-topic{
            border: 1px solid #333333;

          }
          .box-post{

              border-bottom: 1px solid #333333;
          }
          img
          {
              display: block;
              transition: .5s ease;
              backface-visibility: hidden;

          }
          img:hover{
            transition: .5s ease;
            opacity: 0.5;


          }
          .date-post
          {
            text-align: center;
            width: 150px;
            height: 50px;
            border: 1px solid #333333;

          }
          .title-topic{

            margin-top:1.5rem;
            margin-bottom:1.5rem;

          }
          .title-topic-new{
              text-transform: uppercase;
          }
          .box-reply {
            border: 1px solid #333333;
          }



        </style>
    @yield('head')
</head>
<body>
    <div class="container-fluid">
                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                        <a class="navbar-brand" href="{{ route('home') }}"><h1 style="font-size: 1.6rem;">WatchStore</h1></a>
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

                                        <a class="dropdown-item text-capitalize" href="{{ Route('brands_products.thuong-hieu',['slug'=>$item->slug]) }}">
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

                                          <a class="dropdown-item text-capitalize" href="{{ Route('category_products.loai-san-pham',['slug'=>$item->slug] )}}">
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

                                          <a class="dropdown-item text-capitalize" href="{{ Route('gender.index',['slug'=>$item->slug])}}">
                                              <i class="fas fa-angle-double-right"></i> {{ $item->name }}
                                          </a>
                                      </div>

                                  </div>
                                  @endforeach
                                </div>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link nav__name" href="{{ Route('tin-thuc.index') }}" >
                                    Tin Tức
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link nav__name" href="{{ Route('contact') }}" >
                                  Liên Hệ
                                </a>
                              </li>

                          </ul>
                          <ul class="navbar-nav ml-md-auto account">
                            @if (!Auth::guard('khachhang')->check())
                            <li class="nav-item">
                                <a class="nav-link nav__name login" href="{{ Route('get_dang_nhap_user') }}">
                                     Đăng Nhập
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav__name" href="">
                                        Đăng Ký
                                </a>
                            </li>
                            @endif
                            @if (Auth::guard('khachhang')->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-users"></i>  Xin Chào  {{
                                 Auth::guard('khachhang')->user()->name }}

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="#"><i class="fas fa-users"></i><span class="item-margin-5">Thông Tin</span></a>
                                  <a class="dropdown-item" href="#"><i class="fas fa-cogs "></i><span class="item-margin-5">Setting</span></a>
                                  <a class="dropdown-item" href="{{ Route('logoutUser') }}"><i class="fas fa-sign-out-alt"></i><span class="item-margin-5">Đăng Xuất</span></a>
                                </div>
                              </li>
                            @endif

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
    <div class="modal login-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Đăng Nhập</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ Route('post_dang_nhap_user') }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">Chúng tôi không bao giờ chia sẻ email của bạn với bất cứ ai khác.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Mật Khẩu</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  autocomplete="on">
                    </div>
                  </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Đăng Nhập</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
               </form>
            </div>
          </div>
        </div>
      </div>

    @if (session('message'))
    <!-- Modal -->
    @php
        $type=session('message');
    @endphp
    <div  class="modal fade thongbao" id="thongbao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-{{ $type["type"] }}" id="exampleModalCenterTitle">Thông Báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="text-{{ $type["type"] }}">{{ $type["msg"] }}</div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>

            </div>
        </div>
        </div>
    </div>
    @endif
    <div  class="modal fade message"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-success" id="exampleModalCenterTitle">Thông Báo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="text-success text-message"></div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>

            </div>
        </div>
        </div>
    </div>


    <script src="{{asset('js/jquery/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="{{ asset('js/jquery/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bs4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/brands.js') }}"></script>
    <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/solid.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.lazy.plugins.min.js') }}"></script>
    <script>
        $(function(){
            $('.lazy').lazy();
            $(".thongbao").modal('show');
        });
        $(document).ready(function(){

            $(".login").click(function(event){
                event.preventDefault();
                $(".login-modal").modal('show');
            });
        });
    </script>



</body>

@yield('script')
</html>
