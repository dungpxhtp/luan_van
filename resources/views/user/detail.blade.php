@extends('user.layoutsite')
@section('title')
     {{$product->name}}   
@endsection
@section('main')
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                     <div class="col-md-12 text-center">
                        <h3 class="title-product-news title-brands text-uppercase"> <span class="span-title-brands">{{$product->name}} - {{$product->name_gendercategoryproducts }} - {{$product->name_categoryproducts}}</span></h3>
                    </div>
                    <div class="col-md-12 text-center">
                        BreachCurm
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
                       <a class="nav-link btn-btn-sm hvr-grow active" data-toggle="tab" href="#home">Mô Tả</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link hvr-grow" data-toggle="tab" href="#menu1">Chi Tiết Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-grow" data-toggle="tab" href="#menu2">Chế Độ Bảo Hành Và Hậu Mãi</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                    <h3>HOME</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                    <h3>Menu 1</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="container tab-pane fade"><br>
                    <h3>Menu 2</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>   
                </div>
            </div>
        </div>
    </div>
@endsection