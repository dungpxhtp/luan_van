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
                                            @if (isset($product->pricesale))
                                           <div> <span> {{ number_format($product->price) }} VNĐ </span></div>
                                            <div>
                                                <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($product->pricesale) }} VNĐ </span>
                                                {{-- ROUND làm tròn số --}}
                                                <span style="display: inline-block; background-color: #FA5130; color: white; padding: 5px 5px;font-weight: 700;">  {{round( ( ( $product->price - $product->pricesale ) / $product->price ) * 100 ) }} % GIẢM</span>
                                            </div>
                                           @else
                                           <div> <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($product->price) }} VNĐ </span> </div>

                                            @endif

                                        </p>
                                        <p class="description">
                                            <span class="desc">{{$product->metadesc}}</span>
                                        </p>
                                </div>
                                  <div class="col-md-12 text-center ">
                                     <a href="{{ Route('cart-add',['id'=>$product->id]) }}" class ="btn btn-sm add-cart text-white text-uppercase hvr-grow ">Thêm Vào Giỏ Hàng</a>
                                     <span class="hotline">
                                         Gọi đặt mua: <a style="color: #c40d2e;" href="tel:0356581777">0356581777</a> (7:30-21:30)
                                     </span>
                                    </div>
                                    {{--  Giỏ Hàng ({{ $cart->total_quanlity}})  --}}

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
                        <form class="form-comment">
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Bình Luận Về Sản Phẩm</label>
                              <textarea class="form-control counted input-comment" name="input-comment" placeholder="Mời Bạn Nhập Bình Luận Về Sản Phẩm" rows="3" ></textarea>
                              <h6 class="pull-right counter"  style="margin-top: 10px; display: none;"></h6>
                            </div>
                            <button  value="{{ Route('commentProduct',['id_products'=>$product->id]) }}" class="btn btn-sm btn-success btn-submit-comment" >Bình Luận</button>
                        </form>
                </div>
            </div>
            <div id="showcomment">
            @includeIf('user.layout.comment.replyComment')
            </div>
        </div>
    </div>

    @includeIf('user.layout.loading.loading');

@endsection
@section('script')
    <script src="{{ asset('carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            function reloadComment(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#showcomment').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            };

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
            });
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            });

            $('.input-comment').focus(function(){
                $('.counter').show();
            });




            $(document).on("click",".btn-submit-comment",function(event){
                event.preventDefault();
                var url = $(".btn-submit-comment").val();
                var locationhref=window.location.href;
                console.log(locationhref);

                var text=$(".input-comment").val();

                if(!$(".input-comment").val().length)
                {
                    alert('Vui Lòng Nhập Nội Dung Bình Luận');
                }else
                {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : url,
                    type:'POST',
                    data:$('.form-comment').serialize(),
                    contentType:'application/x-www-form-urlencoded;     charset=UTF-8' ,
                    dataType:"JSON",
                    success:function(data)
                    {

                        if(data.success)
                        {
                          $(".input-comment").val('');
                           /* $('.text-message').append(data.success);
                            $('.message').modal('show');*/
                            alertify.success(data.success);
                             setTimeout(function(){
                                reloadComment(locationhref);
                                $('.message').modal('hide');
                                $(".text-message").empty();
                            },2000);

                        }
                    }
                });




            }

            });

        });


        $(function() {
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#load a').css('color', '#dfecf6');
                $('#load').append('<i class="fas fa-spinner"></i>');

                var url = $(this).attr('href');
                getArticles(url);
                //window.history.pushState("", "", url);
            });

            function getArticles(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#showcomment').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            }
        });

        //show box comment

    </script>

    <script type="text/javascript" src="{{ asset('js/myJs/demsokitu.js') }}">
    </script>

@endsection
