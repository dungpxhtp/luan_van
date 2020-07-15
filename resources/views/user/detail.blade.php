@extends('user.layoutsite')
@section('title')
     {{$product->name}}
@endsection
@section('head')
        <link rel="stylesheet" href="{{ asset('carousel/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('carousel/css/owl.theme.default.min.css') }}">

@endsection
@section('main')
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end back">
                    <a href="{{ url()->previous() }}">Quay Trở Lại</a>
                </div>
            </div>
            <div class="row my-3">
                    <div class="col-md-12 text-center">
                        {{ Breadcrumbs::render('detail',$product->name_gendercategoryproducts,$product->name) }}
                    </div>
                    <div class="col-md-12 text-center">
                        <h3 class="title-product-news title-brands text-uppercase"> <span class="span-title-brands">{{$product->name}} - {{$product->name_gendercategoryproducts }} - {{$product->name_categoryproducts}}</span></h3>
                    </div>

            </div>

        </div>
    </div>
    <div class="clearfix my-5">
       <div class ="container">
            <div class="row">
                    <div class="col-md-3 my-3">
                        <div class ="box-img">
                            <img class="card-img-top lazy" data-src="{{ $product->image }}" alt="{{ $product->slug }}" style="width:250px ; height:250px;">
                        </div>
                    </div>
                    <div class="col-md-4 my-3">
                          <h3 class="title-product-detail text-uppercase text-center"> <span class="span-title-brands">Thông Tin Sản Phẩm</span></h3>
                          <div class ="row">
                                <div class="col-md-12">
                                        <span class="sku_wrapper text-uppercase">
                                        mã số sản phẩm :
                                        <span class="sku">
                                            {{$product->code}}
                                        </span>
                                        </span>
                                        <p class="price-product">
                                           <span> {{ number_format($product->price) }} VNĐ </span>
                                        </p>
                                        <p class="description">
                                            <span class="desc">{{$product->metadesc}}</span>
                                        </p>
                                </div>
                                  <div class="col-md-12 text-center ">
                                     <a class ="btn btn-sm add-cart text-white text-uppercase hvr-grow ">Thêm Vào Giỏ Hàng</a>
                                     <span class="hotline">
                                         Gọi đặt mua: <a style="color: #c40d2e;" href="tel:0356581777">0356581777</a> (7:30-21:30)
                                     </span>
                                    </div>
                          </div>
                    </div>
                    @includeIf('user.layout.detail-right-product')
            </div>
       </div>
    </div>
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                       <a class="nav-link btn-btn-sm hvr-grow active" data-toggle="tab" href="#home">Chi Tiết Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link hvr-grow" data-toggle="tab" href="#menu1">Mô Tả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-grow" data-toggle="tab" href="#menu2">Chế Độ Bảo Hành Và Hậu Mãi</a>
                    </li>
                </ul>
                <div class="tab-content my-3">
                    <div id="home" class="container tab-pane active"><br>
                        @includeIf('user.layout.detail-title-description');
                    </div>
                    <div id="menu1" class="container tab-pane fade">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                       <p>
                                         {!!$product->detail !!}
                                                </p>
                                            </div>
                                        </div>
                                </div>

                    </div>
                    <div id="menu2" class="container tab-pane fade">
                            @includeIf('user.layout.detail-guarantee');
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix my-5">
        <div class="container">
                @includeIf('user.layout.detail-related-product', ['id' => $product->id_brandproducts])
        </div>
    </div>
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <div class="row my-3">
            @foreach ($comment as $item)
                @if ($item->parentid == 0)


                <div class="col-md-12 my-5">
                    <h5 class="name-comment">{{ $item->nameuser }}</h5>
                    <span class="text-comment">{{ $item->commentText }}</span>
                    <div class="comment-acttion">
                        <a href="">Trả Lời</a>
                        <span>{{ $item->created_at }}</span>
                    </div>


                @else
                        @includeIf('user.layout.comment.replyComment', ['id' =>  $item->parentid ])
                </div>
                @endif


            @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                lazyLoad:true,
                margin:10,
                responsiveClass:true,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:4,
                        nav:true,
                        loop:true
                    }
                }
            });
            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
          });
    </script>
@endsection
