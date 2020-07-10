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
                        <th scope="col">Ngày Đăng Ký</th>


                    </tr>
                    </thead>
                    <tbody>


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
