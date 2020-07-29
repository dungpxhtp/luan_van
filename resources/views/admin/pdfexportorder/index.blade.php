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
    <div class="container" style="border: 1px solid;">
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
                          <input type="text" class="form-control form-control-sm" name="fullName" value="{{ $orders->fullName }}" required>
                        </div>
                        <div>
                            @if ($errors->has('fullName'))
                            <span class="text-danger">{{ $errors->first('fullName') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Số Điện Thoại</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" name="phoneOder" value="{{ $orders->phoneOder }}" required>
                          @if ($errors->has('phoneOder'))
                          <span class="text-danger">{{ $errors->first('phoneOder') }}</span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" >Địa Chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control form-control-sm" name="Address" value="{{ $orders->Address }}"     required>
                          @if ($errors->has('Address'))
                          <span class="text-danger">{{ $errors->first('Address') }}</span>
                          @endif
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
                    <th>Giá Gốc 1/sp</th>
                    <th>Thành Tiền(giá mua)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordersproducts as $item )
                    @if($item->serinumber ==1)

                            @for($i=0 ;$i<$item->quantity ; $i++)
                                <tr>
                                    <td>
                                        <div style="width:100%">
                                            <textarea class="form-control" name="name_product[]" readonly rows="3" >{{ $item->nameproducts }}</textarea>
                                            @if ($errors->has('name_product[]'))
                                            <span class="text-danger">{{ $errors->first('name_product[]') }}</span>
                                            @endif
                                        </div>
                                            <p><textarea class="form-control"  name="codeproduct[]"  required readonly rows="2">{{ $item->codeproducts }}</textarea>
                                                @if ($errors->has('codeproduct[]'))
                                                <span class="text-danger">{{ $errors->first('codeproduct[]') }}</span>
                                                @endif
                                                <input type="hidden" name="id_product[]" value="{{ $item->id_products }}">
                                            </p>
                                    </td>

                                        <td><textarea class="form-control " name="serinumber[]" placeholder="Nhập Số Serinumber" required  rows="3"></textarea></td>
                                        <td style="width: 20%"> <input type="text" name="quantity[]" value="1" required readonly style="width: 100%;"></td>
                                        <td style="width: 20%">
                                            <input type="text" name="pricecost[]" value="{{ $item->pricecost }}" readonly style="width: 100%;"> VNĐ
                                        </td>

                                        <td class="text-right" style="width: 10%;display: inline-block;">
                                            <input type="text" name="price[]" value="{{ $item->price }}" readonly> VNĐ
                                            @if ($errors->has('price[]'))
                                            <span class="text-danger">{{ $errors->first('price[]') }}</span>
                                            @endif
                                        </td>
                                </tr>
                            @endfor
                    @else
                    <tr>
                        <td>
                            <div style="width:100%">
                                <textarea class="form-control" name="name_product[]" readonly rows="3" >{{ $item->nameproducts }}</textarea>
                            </div>
                            <p><input type="text" name="codeproduct[]" value="{{ $item->codeproducts }}" required readonly>
                                <input type="hidden" name="id_product[]" value="{{ $item->id_products }}">

                            </p></td>

                            <td style="width: 20%">
                                <input type="text" name="serinumber[]" value="Không Có Số Serinumber" readonly  style="width: 100%;"/>
                                    @if ($errors->has('serinumber[]'))
                                    <span class="text-danger">{{ $errors->first('serinumber[]') }}</span>
                                    @endif
                            </td>
                            <td style="width: 20%"> <input type="text" name="quantity[]" value="{{ $item->quantity }}" required readonly style="width: 100%;"></td>
                            @if ($errors->has('quantity[]'))
                            <span class="text-danger">{{ $errors->first('quantity[]') }}</span>
                            @endif
                            <td style="width: 30%">
                                <input type="text" name="pricecost[]" value="{{ $item->pricecost }}" readonly style="width: 100%;"> VNĐ
                            </td>
                            <td class="text-right"  style="width: 10%;display: inline-block;">
                                <input type="text" name="price[]" value="{{ $item->price }}" readonly> VNĐ
                                @if ($errors->has('price[]'))
                                <span class="text-danger">{{ $errors->first('quantity[]') }}</span>
                                @endif
                            </td>

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
                    Cảm Ơn Bạn Đã Tin Tưởng Lựa Chọn Dịch Vụ Của Chúng Tôi.
                    <br>
                    Miễn Phí Vận Chuyển
                    <br>
                    <br>
                <strong> Phương Thức Thanh Toán</strong>
                    <p>
                        @if ($orders->Payments ==1)
                         <input type="text" name="payments " readonly  required value=" Trả Tiền Mặt Khi Nhận Hàng" style="width: 60%;">
                        @else

                        <input type="text" name="payments " readonly  required value=" Chuyển Khoản Ngân Hàng" style="width: 60%;">
                        @endif

                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-10 text-right">


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
