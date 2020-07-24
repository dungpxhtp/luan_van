<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3 style="text-align: center;">{{ $details['title'] }}</h3>
    <p>
        {{ $details['body'] }}
    </p>
    <p>Mã Hóa Đơn : {{ $details['codeorder'] }}</p>
    <p>Phương Thức Thanh Toán : {{ $details['payments'] }}</p>
    <p style="text-align: center;"> Sản Phẩm Bạn Đã Mua </p>
    @foreach ($details['product']->items as $item)
            <p>{{ $item['name'] }} <strong style="color: #CD5F53;">Số Lượng : {{ $item['quantity'] }}</strong></p>
    @endforeach
                                        <span>
                                            Gửi Từ WatchStore
                                        </span>
</body>
</html>
