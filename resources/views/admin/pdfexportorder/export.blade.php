<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Hóa Đơn Bán Hàng</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
        }
        .text-right {
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
        input {
            background-color:transparent;
            border: 0px solid;
            height:30px;
            width:260px;
        }
        input:focus {
            outline:none;
        }
    </style>



</head>
<body class="login-page " style="margin: 10px 10px; ">
    <div class="container" style="border: 1px solid #f75990;">

        <div class="row">
            <div class="col-xs-7">
                <strong> Cửa Hàng</strong>

                <strong>WatchStore.</strong><br>

                Số Điện Thoại: 0356581777 <br>
                Email: thien.phamminhstu@gmail.com <br>

                <br>
            </div>

            <div class="col-xs-4">
                <strong>Hóa Đơn Bán Hàng</strong>
            </div>
        </div>

        <div style="margin-bottom: 0px">&nbsp;</div>

        <div class="row">
            <div class="col-xs-6">
                <h4>Khách Hàng</h4>
                <address>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tên Khách Hàng :</label>
                        <div class="col-sm-10">
                         {{ $ordersexport->fullName }}
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Số Điện Thoại</label>
                        <div class="col-sm-10">
                         {{ $ordersexport->phoneOder }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >Địa Chỉ</label>
                        <div class="col-sm-10">
                          {{$ordersexport->Address }}

                        </div>
                    </div>

                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Mã Hóa Đơn:</th>
                            <td class="text-right">{{ $ordersexport->codeOder }}</td>
                        </tr>
                        <tr>
                            <th> Ngày Xuất Hóa Đơn: </th>
                            <td class="text-right">{{ \Carbon\Carbon::parse(\Carbon\Carbon::now('Asia/Ho_Chi_Minh'))->format('d m Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table style="width: 100%; margin-bottom: 20px">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px"><div> Tổng Hóa Đơn </div></th>
                            <td style="padding: 5px" class="text-right"><strong> {{ \App\library\library_my::formatMoney($ordersexport->TotalOrder)}} VNĐ </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <table class="table">
            <thead style="background: #F5F5F5;">
                <tr>
                    <th>Danh Sách Sản Phẩm</th>
                    <th>SeriNumber </th>
                    <th>Số Lượng</th>
                    <th>Giá Gốc 1/sp</th>
                    <th>Thành Tiền(giá mua)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exportproducts as $item )

                                <tr>
                                    <td>
                                        <div style="width:100%">
                                         {{ $item->nameproducts }}

                                        </div>
                                            <p style="color: #9df9ef;">
                                                {{ $item->codeproducts }}

                                            </p>
                                    </td>

                                        <td>{{ $item->serinumber }}</td>
                                        <td style="width: 30%">
                                            @if($item->serinumber !="Không Có Số Serinumber")
                                            @foreach ($ordersproducts as $itemorders)
                                                    @if ($item->id_products == $itemorders->id_products)
                                                                    1

                                                            @endif
                                                    @endforeach
                                            @else
                                                    @foreach ($ordersproducts as $itemorders)
                                                    @if ($item->id_products == $itemorders->id_products)
                                                            {{ $itemorders->quantity }}

                                                    @endif
                                            @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            @if($item->serinumber !="Không Có Số Serinumber")
                                            @foreach ($ordersproducts as $itemorders)
                                                    @if ($item->id_products == $itemorders->id_products)
                                                              {{  \App\library\library_my::formatMoney($itemorders->price) }}

                                                            @endif
                                                    @endforeach
                                            @else
                                                    @foreach ($ordersproducts as $itemorders)
                                                    @if ($item->id_products == $itemorders->id_products)
                                                            {{  \App\library\library_my::formatMoney($itemorders->price) }}

                                                    @endif
                                            @endforeach
                                            @endif


                                        </td>
                                        <td>
                                            @if($item->serinumber !="Không Có Số Serinumber")
                                                    @foreach ($ordersproducts as $itemorders)
                                                            @if ($item->id_products == $itemorders->id_products)
                                                                    {{  \App\library\library_my::formatMoney($itemorders->price) }}

                                                            @endif
                                                    @endforeach
                                            @else
                                                    @foreach ($ordersproducts as $itemorders)
                                                    @if ($item->id_products == $itemorders->id_products)
                                                            {{  \App\library\library_my::formatMoney($itemorders->price*$itemorders->quantity) }}

                                                    @endif
                                            @endforeach
                                            @endif
                                        </td>

                                </tr>


                @endforeach
            </tbody>
        </table>

            <div class="row">
                <div class="col-xs-6"></div>
                <div class="col-xs-5">
                    <table style="width: 100%">
                        <tbody>
                            <tr class="well" style="padding: 5px">
                                <th style="padding: 5px"><div> Tổng Hóa Đơn </div></th>
                                <td style="padding: 5px" class="text-right"><strong>  {{ \App\library\library_my::formatMoney($ordersexport->TotalOrder)}}VNĐ </strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-bottom: 0px">&nbsp;</div>

            <div class="row">
                <div class="col-xs-8 invbody-terms">
                    Cảm Ơn Bạn Đã Tin Tưởng Lựa Chọn Dịch Vụ Của Chúng Tôi. <br>
                    <br>
                <strong> Phương Thức Thanh Toán</strong>
                    <p>
                       @if ( $ordersexport->Payments ==1)
                          Trả Tiền Mặt Khi Nhận Hàng
                        @else
                            Chuyển Khoản Ngân Hàng
                       @endif

                    </p>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-10 text-right">

                    <h4>Nhân Viên WatchStore</h4>
                    <br>
                    <small>Ký , ghi , rõ họ ,tên </small>
                    <p>
                        {{ Auth::guard('admin')->user()->fullname }}
                    </p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row " style="margin: 20px 0;">
                <div class="col-xs-6 text-left">
                        Nhân Viên Giao Hàng <br>
                        <small>Ký , ghi , rõ họ ,tên </small>
                </div>
                <div class="col-xs-6">
                          Khách hàng<br>
                        <small>Ký , ghi , rõ họ ,tên </small>
                </div>
            </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
               <div class="row">
                    <div class="col-xs-12" style="text-align: center;">
                        <small>Hóa Đơn Này Chỉ Có Tính Chất Tham Khảo Vui Lòng Không Sao Chép Dưới Bất Kì Hình Thức Nào</small>
                    </div>
                </div>
            </div>
        </div>

    </body>



</html>
