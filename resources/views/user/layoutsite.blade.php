
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta name="google-site-verification" content="TWntj5nlCHq2JTgPA6m8oFKvcoOpppzzHSPXXpbmCqs" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Taylor PMT">
    <meta name="robots" content="noodp,index,follow" />
    {{--  all:Bọ tìm kiếm đánh chỉ số tất cả (ngầm định).
    none: Bọ tìm kiếm không đánh chỉ số gì hết.
    index: Đánh chỉ số trang Web.
    noindex: Không đánh chỉ số trang, nhưng vẫn truy vấn đường dẫn URL.
    follow: Bọ tìm kiếm sẽ đọc liên kết siêu văn bản trong trang và truy vấn, xử lý sau đó.
    nofollow: Bọ tìm kiếm không phân tích liên kết trong trang.
    noarchive: Không cho máy tìm kiếm lưu vào bộ nhó bản sao trang Web.
    nocache: Chức năng như thẻ noarchive nhưng chỉ áp dụng cho MSN/Live.
    nosnippet: Không cho bọ tìm kiếm hiển thị miêu tả sinppet của trang trong kết quả tìm kiếm và không cho phép chúng hiển thị trong bộ nhớ (cache hay caching).
    noodp: Ngăn máy tìm kiếm khỏi việc tạo các miêu tả description từ các thư mục danh bạ Web DMOZ như là một phần của snippet trong trang kết quả tìm kiếm.
    noydir: Ngăn Yahoo khỏi việc trích miêu tả trong danh bạ Web Yahoo! diectory để tạo các phần miêu tả trong kết quả tìm kiếm. Giá trị noydir chỉ áp dụng với Yahoo và không có công cụ tìm kiếm nào khác sử dụng danh bạn Web của Yahoo bởi thế giá trị này không được hỗ trợ cho máy tìm kiếm khác..  --}}
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

    <link rel="stylesheet" href="{{ asset('aos/aos.css') }}" />


     <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
              <!-- Default theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
            <!-- Semantic UI theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
            <!-- Bootstrap theme -->
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,500;1,700&display=swap" rel="stylesheet">

      <style>
        html{font-size:62.5%;line-height:1.6rem;font-family:Roboto,sans-serif}body{background-color:#f7f7f7}.cart-payment{display:none}.dropdown{position:static!important}.dropdown-menu{box-shadow:0 .5rem 1rem rgba(0,0,0,.15)!important;margin-top:0!important;width:100%!important}.dropdown-menu-cart{box-shadow:0 .5rem 1rem rgba(0,0,0,.15)!important;margin-top:0!important;width:50%!important}.nav-item{margin:0 10px}.nav__name{font-weight:600}.title-brands{font-weight:600;font-size:1.1rem}.title-product{position:relative;z-index:2;color:#fff;padding:0 20px;font-weight:700;font-size:1.2rem}.title-product::after{content:" ";display:block;border-top:2px solid #900;width:10%;left:0;height:1px;position:absolute;top:50%;z-index:1}.title-product::before{content:" ";display:block;border-top:2px solid #900;width:10%;right:0;height:1px;position:absolute;top:50%;z-index:1}.border-color{border:1px solid #f60;border-radius:10px}.border-color:hover{box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.border-brands-product{border:1px solid #0b0b0b;border-radius:4%}.border-color:hover{box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.margin-item{margin:4px 4px}.span-title{background-color:#f60;color:#fff;padding:6px 20px}.span-title-brands{color:#333}.card-deck{min-height:480px}footer{position:relative;background:#343a40;clip-path:polygon(53% 13%,100% 28%,100% 100%,0 100%,0 0);clear:both;padding-top:50px;padding-bottom:104px;z-index:50}.title-product-detail{font-weight:500;font-size:1rem}.sku_wrapper{display:block;clear:both;color:#000;margin-bottom:10px}.sku{color:#827c7c}.price-product{font-size:1.4rem;color:#827c7c}.add-cart{padding:10px;background:#900}.clear-cart{padding:10px;background:#900}.hvr-grow{display:inline-block;vertical-align:middle;transform:translateZ(0);box-shadow:0 0 1px transparent;backface-visibility:hidden;-moz-osx-font-smoothing:grayscale;transition-duration:.3s;transition-property:transform}.hvr-grow:active,.hvr-grow:focus,.hvr-grow:hover{transform:scale(1.1);box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.hotline{display:block}.border-title-top-bottom{padding:20px 0;border-top:1px solid #ebebeb;border-bottom:1px solid #ebebeb}.description{margin:5px 0;clear:both;text-align:justify}.title-description:nth-child(even){background-color:#efeff1}.text-guarantee{font-weight:700}.reply-comment{margin:5px 20px;background-color:#f1f1f1}#loading{background-color:#fff;position:fixed;display:block;top:0;bottom:0;z-index:1000000;opacity:.5;width:100%;height:100%;text-align:center}#loading img{margin:auto;display:block;left:50%;top:50%;transform:translateX(-50%) translateY(-50%);-webkit-transform:translateX(-50%) translateY(-50%);position:absolute;z-index:999}.page-wrapper{min-height:80vh}.box-topic{border:1px solid #333}.box-post{border-bottom:1px solid #333}img{display:block;transition:.5s ease;backface-visibility:hidden}img:hover{transition:.5s ease;opacity:.5}.date-post{text-align:center;width:150px;height:50px;border:1px solid #333}.title-topic{margin-top:1.5rem;margin-bottom:1.5rem}.title-topic-new{text-transform:uppercase}.box-reply{border:1px solid #333}.btn-facebook{background-color:#3578e5;color:#fff;border-color:rgba(0,0,0,.2);font-size:1.2rem}.btn-google{background-color:#dd4b39;color:#fff;border-color:rgba(0,0,0,.2);font-size:1.2rem}.border-radius{border-radius:20px}.footer-logo{color:#ffff;text-transform:uppercase}.footer-copyright{background:#333}.copyright-content{color:#ffff}.quantity{background-color:#6394f8;border-radius:10px;color:#fff;display:inline-block;font-size:12px;line-height:1;padding:3px 7px;text-align:center;vertical-align:middle;white-space:nowrap}.badge{color:red}.btn-checkout{border-radius:20px;background-color:#900}.text-uppercase{margin:20px 20px;font-size:1.8rem;padding:3px}.navbar{background-color:#fff;text-transform:uppercase}.nav-link{color:#000;font-size:1.3rem;font-weight:700}.nav-tabs>.nav-item{color:#000}.card-title{font-size:1.3rem;text-transform:capitalize}..full-width-row{overflow-x:hidden}.full-width-row>div{margin-left:-15px;margin-right:-15px}.footer-logo{color:#f4ba01;border-bottom:1px solid;width:50%}.content-footer{text-align:center;color:#fff;text-transform:uppercase;font-size:1.3rem;width:50%}.content-contact{display:inline-block}.active{border-bottom:2px solid #f4ba01}.span-title-brands{font-size:1.5rem}#lab_social_icon_footer{padding:40px 0;background-color:#dedede}#lab_social_icon_footer a{color:#333}#lab_social_icon_footer .social:hover{-webkit-transform:scale(1.1);-moz-transform:scale(1.1);-o-transform:scale(1.1)}#lab_social_icon_footer .social{-webkit-transform:scale(.8);-moz-transform:scale(.8);-o-transform:scale(.8);-webkit-transition-duration:.5s;-moz-transition-duration:.5s;-o-transition-duration:.5s}#lab_social_icon_footer #social-fb:hover{color:#3b5998}#lab_social_icon_footer #social-tw:hover{color:#4099ff}#lab_social_icon_footer #social-gp:hover{color:#d34836}#lab_social_icon_footer #social-em:hover{color:#f39c12}.autocomplete-suggestion{padding:2px 5px;white-space:nowrap;overflow:hidden;background-color:#fff!important;width:300px;font-size:1.3rem;line-height:2;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}.autocomplete-selected{background:#696666}.autocomplete-suggestions strong{font-weight:400;color:#39f}.autocomplete-group{padding:2px 5px}.autocomplete-group strong{display:block;border-bottom:1px solid #000}.text-capitalize{font-size:1.4rem;line-height:3}.text-capitalize::after{content:'';display:block;width:0;height:2px;background:#900;transition:width .3s}.text-capitalize:hover::after{width:100%;transition:width .3s}.text-nav{font-weight:700;color:#900}.price{font-size:1.3rem;font-weight:500}.price-sales{font-size:1.4rem;font-weight:700}.span-title-brands{font-size:1.8rem;font-weight:700;color:#900}

        .mh-250px{
            max-height: 250px;
        }
        .mt-70px{
            margin-top:70px;
        }
        .product__item{
            color: #333;
            font-size: 1.4rem;
            font-weight: 700;
            min-height: 40px;
        }
        .product__item:hover {
            text-decoration: none!important;
            color: black;
        }
        .product__img{
            height: 100%;
            object-fit: contain;
        }
        .mh-250px:hover {
            transition: 1s ease-in-out all;
            transform: scaleX(1.02);
        }
        .percent{
            display: block;background-color: #FA5130;color: white;padding: 5px 5px;font-weight: 700;width: 80px;margin: 10px auto 0;
        }
        .back a{
            font-size: 1.3rem;
            color: #900;
            text-decoration: none;
            font-weight: 500;
            border-bottom: #900 1px solid;
        }
    </style>
        @yield('style')
    @yield('head')
</head>
<body>
    <div class="container-fluid">
                <header>

                    <nav class="navbar navbar-expand-lg  fixed-top" style="background-color: rgba(255, 255, 255, 0);">
                        <div class="container">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="https://watchstore.vn/storage/files/watchshop-logoV3.svg" style="width: 100px;" alt="logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"><i class="fas fa-bars" style="background-color: #6394f8;"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            {{-- Quản Lý Sản Phẩm --}}
                            <li class="nav-item dropdown">
                              <a class="nav-link nav__name dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Thương Hiệu
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <span class="text-uppercase text-nav">  Các Hãng  </span>
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
                                  <span class="text-uppercase text-nav">  Loại Sản Phẩm </span>
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
                                  <span class="text-uppercase text-nav">  Đối Tượng</span>
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
                              <li class="nav-item">

                                    <a href="" class="nav-link nav__search"> <i class="fas fa-search"></i></a>

                              </li>
                              {{-- <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                              </form> --}}

                          </ul>

                          <ul class="navbar-nav ml-md-auto account">
                            @if (!Auth::guard('khachhang')->check())
                            <li class="nav-item">
                                <a class="nav-link nav__name login" href="{{ Route('get_dang_nhap_user') }}">
                                     Đăng Nhập
                                </a>
                            </li>
                            <li class="nav-item resgister">
                                <a class="nav-link nav__name" href="{{ Route('resgister') }}">
                                        Đăng Ký
                                </a>
                            </li>
                            @endif
                            @if (Auth::guard('khachhang')->check())
                            <li class="nav-item dropdown cart-detail">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>  Giỏ Hàng

                                </a>
                                <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <div class="dropdown-item">
                                                <div class="box-cart"></div>
                                        </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-users"></i>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ Route('accountUser') }}"><i class="fas fa-users"></i><span class="item-margin-5">Thông Tin</span></a>
                                  <a class="dropdown-item" href="{{ Route('cart_order_user') }}"><i class="fas fa-notes-medical"></i><span class="item-margin-5">Đơn Hàng</span></a>
                                  <a class="dropdown-item" href="{{ Route('logoutUser') }}"><i class="fas fa-sign-out-alt"></i><span class="item-margin-5">Đăng Xuất</span></a>
                                </div>
                            </li>
                            @endif

                          </ul>
                        </div>
                    </div>
                    </nav>
                </header>
                <div class="p-0 full-width-row">
                    @yield('banner')
                </div>
                <main class="page-wrapper my-3">
                  @yield('main')
                </main>
                <div class="fb-chat">
                    <!-- Load Facebook SDK for JavaScript -->
                        <div id="fb-root"></div>
                        <script>
                            window.fbAsyncInit = function() {
                            FB.init({
                                xfbml            : true,
                                version          : 'v7.0'
                            });
                            };

                            (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>

                        <!-- Your Chat Plugin code -->
                        <div class="fb-customerchat"
                            attribution=setup_tool
                            page_id="340207426736206"
                    theme_color="#fa3c4c"
                    logged_in_greeting="Bạn Cần Giúp Gì"
                    logged_out_greeting="Bạn Cần Giúp Gì">
                        </div>
                </div>
                <footer class="container-fluid ">
                    <div class="p-0 full-width-row">
                    <div class="row m-4 ">
                        <div class="col-md-8">
                            <h3 class="footer-logo">
                               Về Chúng Tôi
                            </h3>
                            <p class="content-footer">
                                Trường Đại Học Công Nghệ Sài Gòn <br>
                                Luận Văn Xây Dựng Website Bán Đồng Hồ Dựa Trên Nền Tảng framework laravel  <br>
                                 Bootstrap 4  , jquery , Ajax<br>
                                Giảng Viên Hướng Dẫn : <span class="text-teacher">Bùi Nhật Bằng</span> <br>
                                Sinh Viên Thực Hiện : <span class="text-student">Phạm Minh Thiện</span>
                            </p>
                        </div>
                        <div class="col-md-4" style="margin-top: 30px;">
                            <h4 class="footer-logo">
                                Thông Tin Liên Hệ
                            </h4>
                            <p class="content-contact">
                                <section id="lab_social_icon_footer">
                                    <!-- Include Font Awesome Stylesheet in Header -->
                                    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
                                    <div class="container">
                                            <div class="text-center center-block">
                                                    <a href="https://www.facebook.com/thien.phamminhstu"><i id="social-fb" class="fab fa-facebook fa-3x social"></i></a>
                                                    <a href="https://twitter.com/thinphm34098405"><i id="social-tw" class="fab fa-twitter-square fa-3x social"></i></a>
                                                    <a href="tel:0356581777"><i id="social-gp" class="fas fa-phone fa-3x social"></i></a>
                                                    <a href="mailto:thien.phamminhstu@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
                                        </div>
                                    </div>
                                    </section>




                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex    justify-content-center text-center">
                            <h4 class="footer-logo">
                               Phương thức thanh toán
                            </h4>

                        </div>
                    </div>

                    </div>

                </footer>
                <div class="coppy-right">
                    <div class="row footer-copyright  ">
                        <div class="col d-flex justify-content-center">
                           <p class="copyright-content"> Copyright © Phạm Minh Thiện</p>
                        </div>
                    </div>
                </div>
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
                      <input type="email" required class="form-control border-radius" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">Chúng tôi không bao giờ chia sẻ email của bạn với bất cứ ai khác.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Mật Khẩu</label>
                      <input type="password" required name="password" class="form-control border-radius" id="exampleInputPassword1" placeholder="Password"  autocomplete="on">
                    </div>
                  </div>
            <div  style="border-top: 1px solid #dee2e6;">

             <div class="row my-2">
                 <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-login border-radius"> <i class="fas fa-sign-in-alt"></i> Đăng Nhập</button>
                 </div>
             </div>

               </form>

            </div>
            <div style="border-top: 1px solid #dee2e6;">
                <div class="box-login" style="">
                    <div class="row my-2">
                        <div class="col-md-12">
                            <a href="{{ Route('resetPassword') }}" class="btn btn-sm btn-warning">Quên Mật Khẩu</a>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="{{ Route('loginfacebook') }}" class="btn btn-sm btn-facebook border-radius"><i class="fab fa-facebook-square"></i> Đăng Nhập Facebook</a>
                            <a href="{{ Route('logingoogle') }}" class="btn btn-sm btn-google  border-radius" > <i class="fab fa-google"></i> Đăng Nhập Google</a>

                        </div>
                    </div>
                </div>
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
    <div class="modal modalsearch" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;">
          <div class="modal-content" style=" height: auto;
          min-height: 100%;
          border-radius: 0;
          box-shadow: none;">
            <div class="modal-header" style="  border-bottom: none;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style=" opacity: 1;
              font-size: 30px;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="  text-align: center;border-bottom: none;">
                <form class="form-inline my-2 my-lg-0" style=" margin: 0 auto;
                float: none;
                width: 300px;" action="{{ Route('view_search_result') }}" method="GET">

                  <input class="form-control" type="search" placeholder="Nhập Vào Sản Phẩm Cần Tìm" required  name="keyword" id="keyword" style="width: 100%" >
                </form>
            </div>
            <div class="modal-footer" style="  border-bottom: none;
            ">

            </div>
          </div>
        </div>
      </div>

    @includeIf('user.layout.loading.loading')
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
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="{{ asset('js/jquery/jquery.autocomplete.min.js') }}"></script>
    <script>
        $(document).on("click",'.nav__search',function(event){
                event.preventDefault();
                $('.modalsearch').modal('show');

            $("#keyword").autocomplete({
                serviceUrl:'{{ Route('search_complete') }}',
                paramName:'keyword',
                onSelect:function(suggestions)
                {
                    $("#keyword").val(suggestions.value);
                },
                transformResult:function(response)
                {
                    return {
                        suggestions:$.map($.parseJSON(response),function(item){
                            return {
                                value:item.name,
                            };
                        })
                    };
                },
            });
        });


        $(function(){
            $('.lazy').lazy();
            $(".thongbao").modal('show');
        });
        $(document).ready(function(){
            $(document).ajaxStart(function() {
                $("#loading").show();
            });
            $(document).ajaxStop(function() {
                $("#loading").hide();
            });
            $(".login").click(function(event){
                event.preventDefault();
                $(".login-modal").modal('show');
            });
            $('.cart-active').click(function(){
                $('.bag-cart').show();
            });
            $(function(){
                $.ajax({
                    url:'{{ Route('gio-hang') }}',
                    type:'GET',

                }).done(function(data){

                    $('.box-cart').html(data);
                });
            });
            function getCart(){
                $.ajax({
                    url:'{{ Route('gio-hang') }}',
                    type:'GET',

                }).done(function(data){

                    $('.box-cart').html(data);
                });
            };
                  //add Cart shopping
                  $(document).on('click','.add-cart',function(event){
                    event.preventDefault();

                    var url = $(this).attr('href');
                    $.ajax({
                        url:url,
                        type:'GET',
                        success:function(data)
                        {
                            alertify.success(data.success);
                        }
                    }).done(function(){
                            getCart();
                    });

                });

                //giam số lượng
                $(document).on('click','.reduct-cart',function(event){
                    event.preventDefault();
                    var url=$(this).attr('href');
                    $.ajax({
                        url :url ,
                        type:'GET',
                        success:function(data)
                        {
                            alertify.success(data.success);
                        }
                    }).done(function(){
                        getCart();
                    });
                });
            // xóa sản phẩm
                $(document).on('click','.remove-cart',function(event){
                    event.preventDefault();
                    var url =$(this).attr('href');
                    $.ajax({
                        url:url,
                        type:'GET',
                        success:function(data)
                        {
                            alertify.success(data.success);
                        }
                    }).done(function(){
                        getCart();
                    });
                });

             //xóa giỏ hàng
                $(document).on('click','.clear-cart',function(event){
                    event.preventDefault();
                    var url =$(this).attr('href');
                    $.ajax({
                        url:url,
                        type:'GET',
                        success:function(data)
                        {
                            alertify.error(data.success);
                        }
                    }).done(function(){
                        getCart();
                    });
                });

             //style croll top
             $(window).scroll(function(){
                var scroll = $(window).scrollTop();
                if(scroll < 10){
                    $('.fixed-top').css('background', 'transparent');
                    $('.nav-link').css('color',' rgb(0, 0, 0)')
                    $('.navbar').fadeIn();
                } else{
                    $('.fixed-top').css('background', 'rgba(0, 0, 0, 0.5)');
                    $('.nav-link').css('color','  rgb(255, 255, 255)')
                }
            });


            //active nav
            $(function(){
                var current_page_URL = location.href;
                $( "a" ).each(function() {
                   if ($(this).attr("href") !== "#") {
                     var target_URL = $(this).prop("href");
                     if (target_URL == current_page_URL) {
                        $('nav a').parents('li, ul').removeClass('active');
                        $(this).parent('li').addClass('active');
                        return false;
                     }
                   }
                });
              });
             //end
        });
    </script>

    <script src="{{ asset('aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>

</body>

@yield('script')
</html>
