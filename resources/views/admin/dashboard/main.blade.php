@extends('admin.layoutsite')
@section('title')
    Dashboard
@endsection
@section('head')

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <style>
        .highcharts-credits{
            display: none;
        }
    </style>
    <style>
        :root {
            --background-color: #fff;
            --border-color: #ccc;
            --text-color: #555;
            --selected-text-color: rgb(56, 241, 164);
            --hover-background-color: #eee;
        }

        .yearpicker-container {
            position: absolute;
            color: var(--text-color);
            width: 280px;
            border: 1px solid var(--border-color);
            border-radius: 3px;
            font-size: 1rem;
            box-shadow: 1px 1px 8px 0px rgba(0, 0, 0, 0.2);
            background-color: var(--background-color);
            z-index: 10;
            margin-top: 0.2rem;
        }

        .yearpicker-header {
            display: flex;
            width: 100%;
            height: 2.5rem;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
            justify-content: space-around;
        }

        .yearpicker-prev,
        .yearpicker-next {
            cursor: pointer;
            font-size: 2rem;
        }

        .yearpicker-prev:hover,
        .yearpicker-next:hover {
            color: var(--selected-text-color);
        }

        .yearpicker-year {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0.5rem;
        }

        .yearpicker-items {
            list-style: none;
            padding: 1rem 0.5rem;
            flex: 0 0 33.3%;
            width: 100%;
        }

        .yearpicker-items:hover {
            background-color: var(--hover-background-color);
            color: var(--selected-text-color);
            cursor: pointer;
        }

        .yearpicker-items.selected {
            color: var(--selected-text-color);
        }

        .hide {
            display: none;
        }

        .yearpicker-items.disabled {
            pointer-events: none;
            color: #bbb;
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
    </div>
        <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <i class="far fa-calendar-alt"></i> <input type="text" class="yearpicker" value="">
                        <div id="reportPage">
                        <div  id="users"></div>
                        </div>
                    </div>
            </div>
        </div>
   </div>

   <div class="container my-5">

            <div class="row">
                <div class="col-md-12">
                    <i class="far fa-calendar-alt"></i> <input type="text" id="yearorder" value="">
                    <div id="orders">

                    </div>
                </div>
            </div>
   </div>
</div>
    <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <i class="far fa-calendar-alt"></i> <input type="text" id="yearordertotals" value="">

                    <div  id="totals"></div>

                </div>
        </div>
    </div>
    </div>

   {{--Thông kê đơn hàng trong ngày --}}

   {{-- transactions Card --}}
   <div class="container-fluid my-5">
    <nav aria-label="Page breadcrumb" class="my-3">
        <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-money-check-alt"></i>Đơn Hàng Mới</li>
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
   <script src="{{ asset('datePicker/datePicker.js') }}">
   </script>
   <script src="{{ asset('js/myJs/readmoneyvnd.js') }}"></script>
    <script>

        $(document).ready(function(){
            var users;
            var d = new Date();

            $(".yearpicker").yearpicker({
                startYear:2019,
                endYear:d.getFullYear(),
                onChange : function(value){
                    alertify.success("Tải Dữ Liệu");
                        setTimeout(function(){
                            var year=value;
                            let url="{{ Route('chartsYearUser',':id') }}";
                            url=url.replace(':id',year);
                              $.ajax({
                                  async:false,
                                  url:url,
                                  type:"GET",




                              }).done(function(data){
                                  var categories=new Array();
                                  var number=new Array();
                                /*  Object.keys(data).forEach(function (key) {

                                      categories.push(" Tháng "+key);

                                   });
                                   */

                                   Object.entries(data).forEach(entry => {
                                      const [key, value] = entry;
                                      categories.push(" Tháng "+key);
                                      number.push(value.length);
                                    });




                             Highcharts.chart('users', {

                                  title: {

                                      text: 'Thống Kê  Lượt Tạo Tài Khoản Từng Tháng Theo Năm '+value

                                  },
                                  exportFileName: "pdf file",

                                  exporting: {
                                    enabled: true // hide button
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

                                          text: 'Số lượt tạo tài khoản'

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
                        },1000);


                }

                /* đóng hàm */


              });

              /*end */





              $("#yearorder").yearpicker({
                startYear:2019,
                endYear:d.getFullYear(),
                onChange:function(value)
                {
                    setTimeout(function(){
                        var year=value;
                        let url="{{ Route('chartsOrders',':id') }}";
                        url=url.replace(':id',year);
                          $.ajax({
                              async:false,
                              url:url,
                              type:"GET",




                          }).done(function(data){
                              var categories=new Array();
                              var number=new Array();
                            /*  Object.keys(data).forEach(function (key) {

                                  categories.push(" Tháng "+key);

                               });
                               */
                               Object.entries(data).forEach(entry => {
                                  const [key, value] = entry;
                                  categories.push(" Tháng "+key);
                                  number.push(value.length);


                                });




                         Highcharts.chart('orders', {

                              title: {

                                  text: 'Thống Kê Số Lượng Đặt Mua Hàng  '+value

                              },
                              exportFileName: "pdf file",

                              exporting: {
                                enabled: true // hide button
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

                                      text: 'Tổng số hóa đơn trong năm'

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
                    },1000);

                }
              });
              $("#yearordertotals").yearpicker({
                startYear:2019,
                endYear:d.getFullYear(),
                onChange:function(value)
                {
                    setTimeout(function(){
                        var year=value;
                        let url="{{ Route('danhthu',':id') }}";
                        url=url.replace(':id',year);
                          $.ajax({
                              async:false,
                              url:url,
                              type:"GET",




                          }).done(function(data){
                              var categories=new Array();
                              var number=new Array();
                            /*  Object.keys(data).forEach(function (key) {

                                  categories.push(" Tháng "+key);

                               });
                               */

                               console.log(data);
                               //value , key
                                Object.entries(data).forEach((entry) => {

                                    const [key, value] = entry;
                                    console.log(value.thang);

                                  categories.push("Tháng "+value.thang);
                                  number.push(parseInt(value.Total));

                                });




                         Highcharts.chart('totals', {

                              title: {

                                  text: 'DOANH THU MỖI NĂM  '+value

                              },
                              exportFileName: "pdf file",

                              exporting: {
                                enabled: true // hide button
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

                                      text: 'Tổng số hóa đơn trong năm'

                                  },
                                  labels: {
                                    formatter: function() {
                                        var docTien = new DocTienBangChu();
                                        //return this.value
                                           return docTien.doc(this.value);
                                    }
                                },

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



                                  data: number,
                                  name: 'Tổng VNĐ',


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
                    },1000);

                }
              });


              /* var url ="{{ Route('chartsUser') }}";



            $
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
            }();*/
            /*
                    var categories=new Array();
            var number=new Array();
            Object.keys(year).forEach(function (key) {

                categories.push(key);

             });

             Object.entries(year).forEach(entry => {
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
            */

     });


    </script>
@endsection
