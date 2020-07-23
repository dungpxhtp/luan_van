@extends('user.layoutsite')
@section('title')
    Thanh Toán
@endsection
@section('style')
    <style>
        .cart-detail{
            display: none;
        }
        .btn-checkout
        {
            display: none;
        }
        .form-group{
            margin: 10px 0;
        }
        .cart-payment{
            display: block;
        }
    </style>
@endsection
@section('main')

    <div class="clearfix" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="title-product text-uppercase">
                            <span class="span-title">  Thanh Toán</span>
                          </h3>
                    </div>
            </div>
        </div>
    </div>
    <div class="clearfix my-3">
        <div class="container">
            <div class="row">
                    <div class="box-cart"></div>
            </div>


        </div>
    </div>


@endsection
@section('script')

@endsection

