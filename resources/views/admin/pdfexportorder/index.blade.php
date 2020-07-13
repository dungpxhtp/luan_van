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


    </style>



</head>
<body class="login-page">

    <div>
        <form method="POST" enctype="multipart/form-data" action="{{ Route('post_export_pdf_order',['id_orders'=>$orders->id]) }}">
            @csrf
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
                          <input type="text" class="form-control form-control-sm" name="fullName" value="{{ $orders->fullName }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Số Điện Thoại</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" name="phoneOder" value="{{ $orders->phoneOder }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Địa Chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" name="Address" value="{{ $orders->Address }}">
                        </div>
                    </div>

                </address>
            </div>

            <div class="col-xs-5">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <th>Mã Hóa Đơn:</th>
                            <td class="text-right">{{ $orders->codeOder }}</td>
                        </tr>
                        <tr>
                            <th> Ngày Xuất Hóa Đơn: </th>
                            <td class="text-right">{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d m Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table style="width: 100%; margin-bottom: 20px">
                    <tbody>
                        <tr class="well" style="padding: 5px">
                            <th style="padding: 5px"><div> Tổng Hóa Đơn </div></th>
                            <td style="padding: 5px" class="text-right"><strong> {{ \App\library\library_my::formatMoney($orders->TotalOrder)}} VNĐ </strong></td>
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
                    <th class="text-right">Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordersproducts as $item )
                    @if($item->serinumber ==1)

                            @for($i=0 ;$i<$item->quantity ; $i++)
                                <tr>
                                    <td><div><strong>{{ $item->nameproducts }}</strong></div>
                                        <p>{{ $item->codeproducts }}</p></td>

                                        <td><input type="text" name="serinumber" placeholder="Nhập Số Serinumber" /></td>
                                        <td>1</td>

                                        <td class="text-right">{{ $item->price }} VNĐ</td>
                                </tr>
                            @endfor
                    @else
                    <tr>
                        <td><div><strong>{{ $item->nameproducts }}</strong></div>
                            <p>{{ $item->codeproducts }}</p></td>

                            <td><input type="text" name="serinumber" value="Không Có Số Serinumber" readonly /></td>
                            <td>{{ $item->quantity }}</td>


                            <td class="text-right">{{ $item->price }} VNĐ</td>
                    </tr>
                    @endif
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
                                <td style="padding: 5px" class="text-right"><strong> {{ \App\library\library_my::formatMoney($orders->TotalOrder)}} VNĐ </strong></td>
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
                        @if ($orders->Payments ==1)
                            Thanh Toán Trực Tiếp
                        @else
                            Thanh Toán Online
                        @endif

                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 text-right">

                    <h4>Nhân Viên </h4>
                    <p>
                        {{ Auth::guard('admin')->user()->fullname }}
                    </p>
                </div>
            </div>
            <div class="row " style="margin: 20px 0;">
                <div class="col-xs-12 text-center">
                    <a href="{{ Route('orders') }}" class="export btn btn-sm btn-warning" >Quay về</a>

                    <button type="submit" class="export btn btn-sm btn-success" >Tạo Hóa Đơn</button>
                </div>
            </div>
        </div>
    </form>
    </body>



</html>
