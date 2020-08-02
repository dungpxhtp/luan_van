@extends('admin.layoutsite')
@section('title')
    Đơn Hàng Bị Lỗi
@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Đơn Hàng </li>
                 <li class="breadcrumb-item active">Danh Sách Đơn Hàng Lỗi </li>

            </ol>
    </div>

</nav>
<div class="container-fluid my-3">
    <div class="row">
        <div class="col-md-12">
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
    {{-- end tabcontent --}}
    <div id="confirmModal" class="modal fade " role="dialog" >
        <div class="modal-dialog mw-100 w-75">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Chi Tiết Đơn Hàng</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12 box-table-order">
                                <div class="table-responsive my-3">
                                    <table class="table table-bordered table-hover table-striped " id="table_index">
                                        <thead>
                                        <tr>

                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Hình</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Đơn Giá</th>
                                            <th scope="col">Thành Tiền</th>


                                        </tr>
                                        </thead>
                                        <tbody class="tbody_Order">


                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-exit" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
        <script>// load table
            $(document).ready(function(){
                var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";
                $('#table_index').DataTable({
                    processing:true,
                    serverSide:true,
                    language: {
                        "url": Vietnamese
                    },
                    ajax: '{{ Route('fetch_error_order') }}',
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
         //load data
         $(document).on('click','.viewOrder',function(event){
            $('.btn-exit').text('Thoát');
            event.preventDefault();
            var id = $(this).attr("href");
            let url="{{ Route('viewOrder',':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url :url,
                type:"GET",
                dataType:"json",
                jsonpCallback: "index",
                success:function(data)
                {
                    $('.tbody_Order').empty();
                        if(typeof data.success !== 'undefined')
                        {
                            $.each(data.success,function(i,v){
                                var tr=$('<tr>').append(
                                    $('<td>').html(v.nameproducts),
                                    $('<td>').html("<img src='"+v.image+"' style='width:100px;'>"),
                                    $('<td>').html(v.quantity),
                                    $('<td>').html(v.price+ "  VNĐ"),
                                    $('<td>').html(v.TotalProducts + "  VNĐ"),

                                ).appendTo('.tbody_Order');
                            });
                        }
                        $('#confirmModal').modal('show');
                }
            });
        });

        </script>

@endsection
