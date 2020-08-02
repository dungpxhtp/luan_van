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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Đơn Hàng </li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
<div class="container my-3">
    <div class="row">
        <div class="col-md-6">
               <a href="{{ Route('error_order') }}" class="btn btn-danger"> Danh sách đơn hàng bị lỗi</a>
               <a href="{{ Route('view_exportorders') }}" class="btn btn-primary"> Danh Sách Hóa Đơn Xuất</a>
        </div>
    </div>

</div>
    <div class="container my-3">
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">
                        <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#table_dangcho">Danh Sách Đơn Hàng Đang Chờ</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#table_xacnhan">Danh Sách Đơn Hàng Đã Xác Nhận </a>
                        </li>

                </ul>
            </div>
        </div>
    </div>
    {{-- tab content --}}
<div class="tab-content">
    <div class="tab-pane active" id='table_dangcho'>
        @includeIf('admin.orders.modules.tableindex')
    </div>

    <div class="tab-pane fade " id="table_xacnhan">

       @includeIf('admin.orders.modules.tableconfirm')
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
                                        <th scope="col">Chức Năng</th>

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


<div id="thongbao" class="modal fade " role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Đang Xác Nhận Vui Lòng Xin Chờ ....</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>


            </div>
        </div>
    </div>
</div>
@includeIf('admin.message.message');

@endsection
@section('script')

        <script>
            $(function(){

                $(".thongbao").modal('show');
            });
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

                // đơn hàng duyệt
                var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";

                $('#table_confirm').DataTable({
                    processing:true,
                    serverSide:true,
                    language: {
                        "url": Vietnamese
                    },
                    ajax: '{{ Route('fetchordersconfirm') }}',
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
                        {data:'fullnameadmin',name:'fullnameadmin'},
                        {data:'action',name:'action',orderable: false},




                    ]
                });
            });
            //xem danh sách đơn hàng
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
                                        $('<td>').html("<input type='number'  style='width:60px;' class='quantity' id='"+v.id+"' name='quantity[]' min='1' value='"+v.quantity+"'>"),
                                        $('<td>').html(v.price+ "  VNĐ"),
                                        $('<td>').html(v.TotalProducts + "  VNĐ"),
                                        $('<td>').html("<a href='" + v.id + "'  class='updateQuantity btn btn-default btn-info btn-category-color' >Cập Nhật</a>" + "<a href='" + v.id + "' class='delete btn btn-default btn-danger btn-category-color' >Xóa </a>")
                                    ).appendTo('.tbody_Order');
                                });
                            }
                            $('#confirmModal').modal('show');
                    }
                });
            });
            //duyệt đơn hàng
            $(document).on('click','.confirm-order',function(event){
                    event.preventDefault();
                    var id = $(this).attr("href");
                    let url="{{ Route('update_status_orders',':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url:url,
                        type:"GET",
                        dataType:"json",
                        success:function(data)
                        {


                               if(data.success)
                               {
                                alertify.success(data.success);
                               }else
                               {
                                alertify.error(data.danger);
                               }

                        }
                    }).done(function(data){
                        setTimeout(function(){
                            $('#table_index').DataTable().ajax.reload();
                            $('#table_confirm').DataTable().ajax.reload();

                      },1500);

                    });
            });

            $(document).on('click','.updateQuantity',function(event){
                event.preventDefault();

                var id= $(this).attr("href");
                var test=$('.updateQuantity').map(function(){return $(this).attr("href")}).get();

                var value= $('#'+id).val();

                $('.btn-exit').text('xin chờ');
               if(value >0  && value %1 ==0)
               {
                    let url ="{{ Route('update_quantity_order',':id_order_products') }}";
                    url =url.replace(':id_order_products',id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                            url :url,
                            type:'POST',
                            data:'quantity='+value,
                            dataType:'JSON',
                            success:function(data)
                            {
                                if(data.success)
                                {
                                 alertify.success(data.success);
                                 setTimeout(function(){
                                    $('#confirmModal').modal('hide');
                                    $('#table_index').DataTable().ajax.reload();
                                    $('#table_confirm').DataTable().ajax.reload();


                                }, 1000);
                                }

                            }

                    });
               }else
               {
                   alert('nhập lại số lượng số nguyên không âm ');
               }



            });
            //báo lỗi đơn hàng
            $(document).on('click','.error-btn',function(event){
                event.preventDefault();
                var id=$(this).attr('href');
                let url="{{ Route('update_erorr',':id') }}";
                url = url.replace(':id', id);
                console.log(url);
                $.ajax({
                    url :url,
                    type:'GET',
                    success:function(data)
                    {
                        if(data.success)
                        {
                            alertify.success(data.success);
                            setTimeout(function(){
                                $('#confirmModal').modal('hide');
                                $('#table_index').DataTable().ajax.reload();
                                $('#table_confirm').DataTable().ajax.reload();


                            }, 1000);
                        }
                    }
                });


            });


        </script>





@endsection
