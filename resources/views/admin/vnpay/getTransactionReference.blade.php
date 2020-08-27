@extends('admin.layoutsite')
@section('title')
    Kiểm Tra Trạng Thái Giao Dịch
@endsection
@section('main')
{{ Breadcrumbs::render('account','    Kiểm Tra Trạng Thái Giao Dịch') }}
<div class="clearfix my-2">
    @includeIf('admin.products.modules.message')

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <span class="account-header">Kiểm Tra Trạng Thái Giao Dịch</span>

                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12 my-2">
                    <div class="table-responsive my-3">
                        <table class="table table-bordered table-hover table-striped " id="table_index">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã Hóa Đơn</th>
                                <th scope="col">Tên người nhận</th>
                                <th scope="col">Mã Khách Hàng</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Ngày Đặt Hàng</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Địa Chỉ</th>
                                <th scope="col">Hình Thức</th>
                                <th scope="col">Trạng Thái</th>
                                <th scope="col">Chức Năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
            var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";
                    $('#table_index').DataTable({
                        processing:true,
                        serverSide:true,
                        language: {
                            "url": Vietnamese
                        },
                        ajax: '{{ Route('orders.checkTransaction') }}',
                        columns:[
                            {data:'stt',render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }},
                            {data:'codeOder',name:'codeOder'},
                            {data:'fullName',name:'fullName'},
                            {data:'codeuser',name:'codeuser'},
                            {data:'phoneOder',name:'phoneOder'},
                            {data:'exportDate',name:'exportDate'},
                            {data:'TotalOrder',name:'TotalOrder'},
                            {data:'Address',name:'Address'},
                            {data:'Payments',name:'Payments'},
                            {data:'status',name:'status'},

                            {data:'action',name:'action',orderable: false},




                        ]
                    });
        });

    </script>

@endsection
