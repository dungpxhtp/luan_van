@extends('admin.layoutsite')
@section('title')
    Dashboard
@endsection
@section('head')

@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Dashboard</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>
</nav>

   <div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-xl-3 col-lg-6 box-comments">
            <div class="card-header-box-comments shadow">
                <div class="col-xs-3">
                    <i class="fas fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-xs-right">
                    <div class="huge">{{ $countComment }}</div>
                    <span>Total Comment</span>
                </div>
            </div>
            <div class="card-footer-box">
                <a href="javascript:;">
                    <span class="pull-xs-left">View Details</span>
                    <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </a>
            </div>

        </div>
        <div class="col-xl-3 col-lg-6 box-orders">
            <div class="card-header-box-comments shadow">
                <div class="col-xs-3">

                    <i class="fas fa-shopping-cart  fa-5x"></i>
                </div>
                <div class="col-xs-9 text-xs-right">
                    <div class="huge">{{ $countOrders }}</div>
                    <span>Total New Orders</span>
                </div>
            </div>
            <div class="card-footer-box">
                <a href="javascript:;">
                    <span class="pull-xs-left">View Details</span>
                    <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </a>

            </div>
        </div>
        <div class="col-xl-3 col-lg-6 box-products">
            <div class="card-header-box-comments shadow">
                <div class="col-xs-3">
                    <i class="fas fa-clipboard-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-xs-right">
                    <div class="huge">{{ $coutProducts }}</div>
                    <span>Total Product</span>
                </div>
            </div>
            <div class="card-footer-box">
                <a href="javascript:;">
                    <span class="pull-xs-left">View Details</span>
                    <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </a>

            </div>
        </div>
    </div>
   </div>
   {{-- transactions Card --}}
   <div class="container-fluid my-5">
    <nav aria-label="Page breadcrumb" class="my-3">
        <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-money-check-alt"></i>Transactions Card New</li>
                 {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

                </ol>
        </div>
    </nav>
        <div class="row">
            <div class="col-xl-12 box-table-order">
                <div class="table-responsive-sm my-3">
                    <table class="table table-bordered table-hover table-striped " id="myTable">
                        <thead>
                        <tr>

                            <th scope="col">Tên </th>
                            <th scope="col">Mã Đơn Hàng</th>
                            <th scope="col">Ngày Đặt Hàng</th>
                            <th scope="col">Giờ Đặt Hàng</th>

                            <th scope="col">Số Điện Thoại</th>

                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($orderNew as $item)


                                <tr>

                                    <td>{{ $item->nameUser }}</td>
                                    <td>{{ $item->codeOder }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->exportDate)->format('d/m/Y')}}


                                    </td>
                                    <td>

                                        {{ \Carbon\Carbon::parse($item->exportDate)->format('h:i:s')}}
                                    </td>
                                    <td>{{ $item->phoneOder }}</td>

                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="text-xs-right view-all-transaction">
                        <a href="javascript:;">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
   </div>

@endsection
