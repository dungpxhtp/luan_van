@extends('admin.layoutsite')
@section('title')
    Dashboard
@endsection
@section('head')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


    <style>
        .highcharts-credits{
            display: none;
        }
        .ui-datepicker-calendar {
            display: none;
            }
            .current-month{
                display: none;
            }
            .today{
                display: none;
            }
    </style>
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
   {{--  Thống kê lượt đăng ký theo năm  --}}
   <div class="container-fuild my-5">
    <nav aria-label="Page breadcrumb" class="my-3">
        <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-money-check-alt"></i>Biểu Đồ Thống Kê </li>
                 {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

                </ol>
        </div>
    </nav>
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-center">
            <input class="date-own form-control" style="width: 300px;">
    <script>
        $('.date-own').datepicker({
            minViewMode: 1,
            format: 'yyyy'
          });
    </script>
</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="users"></div>
        </div>

    </div>
   </div>
   {{--Thông kê đơn hàng trong ngày --}}

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
@section('script')
    <script>


        $(document).ready(function(){
            var users;
            console.log('ok');

            var url ="{{ Route('chartsUser') }}";
            var return_first = function () {
                var tmp = null;
                $.ajax({
                    'async': false,
                    'type': "GET",
                    'global': false,
                    'url': url,
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
            }();
            var categories=new Array();
            var number=new Array();
            Object.keys(return_first).forEach(function (key) {

                categories.push(key);

             });

             Object.entries(return_first).forEach(entry => {
                const [key, value] = entry;
                categories.push(" Tháng "+key);
                number.push(value.length);
              });


              var d = new Date();

        Highcharts.chart('users', {

            title: {

                text: 'Thống Kê  Lượt Tạo Tài Khoản Trong Năm  Theo Từng Tháng Theo Năm '+d.getFullYear()

            },

            subtitle: {

                text: 'watchstore.vn'

            },

            xAxis: {
                title: {

                    text: 'Tháng'

                },
                categories: categories,

            },

            yAxis: {

                title: {

                    text: 'Số lượt đăng ký'

                }

            },

            legend: {

                layout: 'vertical',

                align: 'right',

                verticalAlign: 'middle'

            },

            plotOptions: {

                series: {

                    allowPointSelect: true

                }

            },

            series: [{

                name: '',

                data: number

            }],

            responsive: {

                rules: [{

                    condition: {

                        maxWidth: 500

                    },

                    chartOptions: {

                        legend: {

                            layout: 'horizontal',

                            align: 'center',

                            verticalAlign: 'bottom'

                        }

                    }

                }]

            }

    });
});
    </script>
@endsection
