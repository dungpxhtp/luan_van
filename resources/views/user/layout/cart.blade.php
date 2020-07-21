@if ($cartoder->total_quanlity > 0 )


<div class="container-fuild">
    <a href="{{ Route('clear') }}" class="btn btn-sm clear-cart text-white text-uppercase hvr-grow"><i class="fas fa-backspace"></i>Xóa Giỏ Hàng</a>

    <div class="row">

        <div class="col-md-3 text-center">
            <i class="fas fa-shopping-cart"></i>  <span class="quantity">{{ $cartoder->total_quanlity }}</span>

        </div>
        <div class="col-md-3 text-center">
            <span>   Tổng Tiền : {{ number_format($cartoder->total_price) }} VNĐ</span>
        </div>
        <div class="col-md-6 text-center">

            <a href="" class="btn btn-sm btn-success btn-checkout"> Thanh Toán</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="table-responsive-sm my-3">
                <table class="table table-striped table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hình</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Giá Tiền</th>
                        <th scope="col">Thành Tiền</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                         @endphp
                        @foreach ($cartoder->items as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img  style="width: 100px; " src="{{ $item['image'] }}" ></td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price']) }} VNĐ</td>
                            <td>{{ number_format($item['price']*$item['quantity']) }} VNĐ</td>
                            <td>
                                <a href="{{ Route('cart-add',['id'=>$item['id']]) }}" class ="btn btn-sm add-cart text-white text-uppercase hvr-grow "><i class="fas fa-plus"></i></a>
                                <a href="{{ Route('giam-so-luong',['id'=>$item['id'],'quantity'=>$item['quantity']-1]) }}" class="btn btn-sm reduct-cart text-white text-uppercase hvr-grow"><i class="fas fa-minus"></i></a>
                                <a href="{{ Route('remove',['id'=>$item['id']]) }}" class="btn btn-sm remove-cart text-white text-uppercase hvr-grow"> <i class="fas fa-trash"></i></a>

                            </td>
                          </tr>

                        @endforeach
                    </tbody>
                  </table>
                </div>
        </div>
    </div>
</div>
@else
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="text-danger">
                    Không Có Sản Phẩm Nào Trong Giỏ Hàng
                </span>
            </div>
        </div>
    </div>

@endif
