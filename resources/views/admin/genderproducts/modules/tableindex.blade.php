<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-table-order">
            <div class="table-responsive my-3">
                <table class="table table-bordered table-hover table-striped " id="table_index">
                    <thead>
                    <tr>
                        <th scope="col"># </th>
                        <th scope="col">Tên </th>



                        <th scope="col">Trạng Thái</th>

                        <th scope="col">Ngày Tạo</th>
                        <th scope="col">Ngày Cập Nhật</th>
                        <th scope="col"></th>


                    </tr>
                    </thead>
                    <tbody>

                        {{--  @foreach ($getData as $item)





                            <tr>
                                <td>#</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
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
                                        <a class="btn btn-danger btn-sm btn-off-status"  href="{{ Route('update_status',['id_brandproducts'=>$item->id]) }}"><i class="fas fa-power-off"></i> Tắt</a>
                                        @elseif($item->status==0)
                                        <a class="btn btn-success btn-sm btn-off-status"  href="{{ Route('update_status',['id_brandproducts'=>$item->id]) }}"><i class="fas fa-power-off"></i> Bật</a>

                                        @endif

                                        <a href="{{ Route('update_brandproduct',['id_brandproducts'=>$item->id,'slug'=>$item->slug]) }}" class="btn btn-info btn-sm">Sửa</a>
                                        <a class="btn btn-sm btn-secondary" href="{{ Route('deleteProducts',['id_product'=>$item->id]) }}">
                                                    <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach  --}}
                    </tbody>
                </table>
                <div class="text-xs-right view-all-transaction">
                    <a href="javascript:;">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
