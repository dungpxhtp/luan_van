@extends('user.layoutsite')
@section('title')
     {{$product->name}}   
@endsection
@section('main')
    <div class="clearfix my-3">
        <div class="container">
            <div class="row">
                     <div class="col-md-12 text-center">
                        <h3 class="title-product-news title-brands text-uppercase"> <span class="span-title-brands">{{$product->name}} - {{$product->name_gendercategoryproducts }} - {{$product->name_categoryproducts}}</span></h3>
                    </div>

            </div>
                  
        </div>
    </div>
@endsection