@extends('admin.layoutsite')
@section('title')
    Quản Lý Hãng
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Khách Hàng</li>

            </ol>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 box-table-order">
            <div class="table-responsive my-3">
                <table class="table table-bordered table-hover table-striped " id="table_index">
                    <thead>
                    <tr>
                        <th scope="col">Mã Khách Hàng</th>
                        <th scope="col">Email </th>
                        <th scope="col">Số Điện Thoại</th>


                        <th scope="col">Tên</th>

                        <th scope="col">Giới Tính</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Chức Năng</th>


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

            </div>
        </div>

    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";
            $('#table_index').DataTable({
                processing:true,
                serverSide:true,
                language:{
                    "url":Vietnamese
                },
                ajax:'{{ Route('users.FetchAjax') }}',
                columns:[
                    {data:'codeuser',name:'codeuser'},
                    {data:'email',name:'email'},
                    {data:'phoneuser',name:'phoneuser'},
                    {data:'name',name:'name'},
                    {data:'gender',name:'gender'},
                    {data:'status',name:'status'},
                    {data:'action',name:'action'},


                ]
            });
        });
    </script>





@endsection
