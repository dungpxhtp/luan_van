<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-table-order">
            <div class="table-responsive-sm my-3">
                <table class="table table-bordered table-hover table-striped " id="myTable">
                    <thead>
                    <tr>
                        <th scope="col"># </th>
                        <th scope="col">Đối Tượng</th>
                        <th scope="col">Tên </th>
                        <th scope="col">Mã Sản Phẩm</th>
                        <th scope="col">Hình</th>

                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Ngày Tạo</th>


                    </tr>
                    </thead>
                    <tbody>






                        @foreach ($getData as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->nameGender }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td><img style='width:250px;height:250px;' src="{{ asset('imageProducts') }}/{{$item->image}}"/>

                                </td>
                                <td>
                                    <span class="btn btn-sm btn-success" style="cursor: default;">{{ $item->status =1 ?"Bật":"" }}</span>
                                </td>
                                <td>
                                   {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}

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
