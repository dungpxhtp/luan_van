<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-table-order">
            <div class="table-responsive-sm my-3">
                <table class="table table-bordered table-hover table-striped " id="myTable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Đối Tượng</th>
                        <th scope="col">Tên </th>
                        <th scope="col">Mã Sản Phẩm</th>
                        <th scope="col">Hình</th>

                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Ngày Tạo</th>
                        <th scope="col">Chức Năng</th>

                    </tr>
                    </thead>
                    <tbody>






                        @foreach ($getData as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->NameLoai }}</td>
                                <td>{{ $item->nameGender }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td><img style='width:150px;height:150px;' src="{{ $item->image }}"/></td>
                                <td>
                                    @if ($item->status ==1)
                                    <span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-toggle-on"></i>Bật</span>
                                    @elseif($item->status==0)
                                    <span class="btn btn-sm btn-danger" style="cursor: default;"><i class="fas fa-toggle-on"></i>Tắt</span>

                                    @endif

                                </td>
                                <td>
                                   {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}

                                </td>
                                <td>
                                    <div class="box-btn">
                                        @if ($item->status ==1)
                                        <a class="btn btn-danger btn-sm btn-off-status"  href="{{ Route('updateStatusProduct',['id_products'=>$item->id]) }}"><i class="fas fa-power-off"></i> Tắt</a>
                                        @elseif($item->status==0)
                                        <a class="btn btn-success btn-sm btn-off-status"  href="{{ Route('updateStatusProduct',['id_products'=>$item->id]) }}"><i class="fas fa-power-off"></i> Bật</a>

                                        @endif

                                        <a href="{{ Route('repair',['slug_products'=>$item->slug,'id_product'=>$item->id]) }}" class="btn btn-info btn-sm">Sửa</a>
                                        <a class="btn btn-sm btn-secondary" href="{{ Route('deleteProducts',['id_product'=>$item->id]) }}">
                                                    <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>

                </table>
                <div class="justify-content-center view-all-transaction">
                    {{-- {!! $getData->links() !!} --}}
                </div>
            </div>
        </div>

    </div>
</div>
