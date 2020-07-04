@extends('admin.layoutsite')
@section('title')
    Quản Lý Hãng
@endsection
@section('head')

@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Đơn Hàng</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>

@include('admin.orders.modules.tableindex')
@includeIf('admin.products.modules.message')

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
                                        <th scope="col">Mã Hóa Đơn</th>
                                        <th scope="col">Tên người nhận</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Ngày Đặt Hàng</th>
                                        <th scope="col">Tổng Tiền</th>
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
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Xuất Hóa Đơn</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
        });
    </script>
        <script>
            $(document).ready(function(){
                var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";

                $('#table_index').DataTable({
                    processing:true,
                    serverSide:true,
                    language: {
                        "url": Vietnamese
                    },
                    ajax: '{{ Route('fetchorders') }}',
                    columns:[
                        {data:'codeOder',name:'codeOder'},
                        {data:'fullName',name:'fullName'},
                        {data:'phoneOder',name:'phoneOder'},
                        {data:'exportDate',name:'exportDate'},
                        {data:'TotalOrder',name:'TotalOrder'},
                        {data:'Address',name:'Address'},
                        {data:'Payments',name:'Payments'},
                        {data:'status',name:'status'},

                        {data:'action',name:'action',orderable: false},




                    ]
                });
            })
            $(document).on('click','.viewOrder',function(event){
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
                    {   console.log(data);
                        $('.tbody_Order').empty();
                            if(typeof data.success !== 'undefined')
                            {
                                $.each(data.success,function(i,v){
                                    var tr=$('<tr>').append(
                                        $('<td>').html(v.nameproducts),
                                        $('<td>').html("<img src='"+v.image+"' style='width:100px;'>"),
                                        $('<td>').html(v.quantity),
                                        $('<td>').html(v.price),
                                        $('<td>').html(v.TotalProducts),
                                    ).appendTo('.tbody_Order');
                                });
                            }
                            $('#confirmModal').modal('show');
                    }
                });
            });
            var id_brands;
            $(document).on('click','.delete_brands',function(event){
                event.preventDefault();
                id_brands = $(this).attr("href");
                $('#ok_button').text('OK');

                $('#confirmModal').modal('show');


            })
            $('#ok_button').click(function(){
                let url="{{ Route('destroy',':id') }}";
                url = url.replace(':id', id_brands);
                $.ajax({
                    url :url,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    type:'GET',
                    jsonpCallback: "index",
                    success:function(data){
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            $('#table_index').DataTable().ajax.reload();
                            alert(data);
                        }, 1000);
                    }

                });
            })

        </script>




@endsection
