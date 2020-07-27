@if (isset($ordersproducts))
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Tên Đồng Hồ</th>
        <th scope="col">Số Lượng</th>
        <th scope="col">Đơn Giá </th>
        <th scope="col">Thành tiền</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($ordersproducts as $item)
        <tr>
            <td>{{ $item->nameproducts }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>

            <td>{{ $item->quantity * $item->price }}</td>
          </tr>
        @endforeach

    </tbody>
  </table>
@endif

