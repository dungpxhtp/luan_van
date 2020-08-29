<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-table-order">
            <div class="table-responsive-sm my-3">
                <table class="table table-bordered table-hover table-striped " id="myTable">
                    <thead>
                    <tr>
                        <th scope="col"># </th>
                        <th scope="col">Tên </th>
                        <th scope="col">Mã Hãng</th>
                        <th scope="col">Trạng Thái</th>

                        <th scope="col">Ngày Tạo</th>
                        <th scope="col"></th>


                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($getData as $item)





                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td>
                                    <span class="btn btn-sm btn-success" style="cursor: default;">{{ $item->status =1 ?"Bật":"" }}</span>
                                </td>
                                <td>
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}

                                </td>
                                <td>
                                    <a href="{{ Route('productbrands',['slug'=>$item->slug]) }}"><i class="fas fa-box-open"></i>Danh sách</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
