@extends('user.layoutsite')
@section('title')
    Đơn Hàng Đặt Mua
@endsection
@section('head')
     {{--  // datatable  --}}
     <link rel="stylesheet" href="{{ asset('jtable/jquery.dataTables.min.css') }}">
@endsection
@section('main')
    {{ Breadcrumbs::render('account','Đơn Hàng Đặt Mua') }}
    <div class="clearfix my-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="title-product text-uppercase">
                        <span class="span-title">Đơn Hàng Của Bạn</span>
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="ml-2">&nbsp;</li>
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Đơn Hàng Của Bạn</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link"  data-toggle="tab" href="#profile" role="tab">Đơn Hàng Đã Xác Nhận</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " data-toggle="tab" href="#messages" role="tab">Đơn Hàng Lỗi</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Đang Giao</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#dagiao" role="tab">Đã Giao</a>
                          </li>
                      </ul>
                </div>
            </div>
            <div class="row my-2">
                   <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane p-2 active" id="home" role="tabpanel">
                            <div class="table-responsive my-3">
                                <table class="table table-bordered table-hover table-striped " id="table_index">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Mã Hóa Đơn</th>
                                        <th scope="col">Tên Người Nhận</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Tổng Hóa Đơn</th>
                                        <th scope="col">Địa Chỉ</th>
                                        <th scope="col">Ghi Chú Đơn Hàng</th>
                                        <th scope="col">Hình Thức Thanh Toán</th>
                                        <th scope="col">Ngày Đặt Hàng</th>
                                        <th scope="col">Tình Trạng</th>
                                        <th scope="col">Xem</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane p-2" id="profile" role="tabpanel">
                            <div class="table-responsive my-3">
                                <table class="table table-bordered table-hover table-striped " id="table_accpect">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Mã Hóa Đơn</th>
                                        <th scope="col">Tên Người Nhận</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Tổng Hóa Đơn</th>
                                        <th scope="col">Địa Chỉ</th>
                                        <th scope="col">Ghi Chú Đơn Hàng</th>
                                        <th scope="col">Hình Thức Thanh Toán</th>
                                        <th scope="col">Ngày Đặt Hàng</th>
                                        <th scope="col">Tình Trạng</th>
                                        <th scope="col">Xem</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane p-2" id="messages" role="tabpanel">
                            <div class="table-responsive my-3">
                                <table class="table table-bordered table-hover table-striped " id="table_error">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Mã Hóa Đơn</th>
                                        <th scope="col">Tên Người Nhận</th>
                                        <th scope="col">Số Điện Thoại</th>
                                        <th scope="col">Tổng Hóa Đơn</th>
                                        <th scope="col">Địa Chỉ</th>
                                        <th scope="col">Ghi Chú Đơn Hàng</th>
                                        <th scope="col">Hình Thức Thanh Toán</th>
                                        <th scope="col">Ngày Đặt Hàng</th>
                                        <th scope="col">Tình Trạng</th>
                                        <th scope="col">Xem</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane p-2" id="settings" role="tabpanel">Settings tab.</div>
                        <div class="tab-pane p-2" id="dagiao" role="table">Đã Giao</div>
                      </div>

                   </div>
            </div>
        </div>
    </div>

    {{--  /* table */  --}}
    <div class="modal   viewproducts" tabindex="-1" role="dialog">
        <div class="modal-dialog mw-100 w-75" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Danh Sách Sản Phẩm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="paginate">
                @includeIf('user.layout.don_hang.danhsach')
                </div>
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('script')

    <script src="{{ asset('jtable/jquery.dataTables.min.js') }}"></script>


    <script>
        $(document).ready(function(){
            var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";

            $('#table_index').DataTable({
                processing:true,
                serverSide:true,
                language: {
                    "url": Vietnamese
                },
                ajax: '{{ Route('fetch_don_hang_all') }}',
                columns:[
                    {data:'stt',render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data:'codeOder',name:'codeOder'},
                    {data:'fullName',name:'fullName'},
                    {data:'phoneOder',name:'phoneOder'},
                    {data:'TotalOrder',name:'TotalOrder'},
                    {data:'Address',name:'Address'},
                    {data:'notes',name:'notes'},
                    {data:'Payments',name:'Payments'},
                    {data:'created_at',name:'created_at'},
                    {data:'status',name:'status'},
                    {data:'action',name:'action'}

                ]
            });


            // view
            $(document).on('click','.view_order',function(event){
                event.preventDefault();
                var url =$(this).attr("href");
                $.ajax({
                    url:url,
                    type:"GET",
                    success:function(data)
                    {
                        alertify.success('Đang tải dữ liệu');
                        $('.paginate').html(data);
                        setTimeout(function(){

                            $('.viewproducts').modal('show');
                        },2000)
                    }
                });
           });

           $(document).on('click','a[href="#profile"]',function(event){
                 $('#table_accpect').DataTable({
                    processing:true,
                    retrieve: true,
                    serverSide:true,
                    language: {
                        "url": Vietnamese
                    },
                    ajax: '{{ Route('fetch_order_accept') }}',
                    columns:[
                        {data:'stt',render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {data:'codeOder',name:'codeOder'},
                        {data:'fullName',name:'fullName'},
                        {data:'phoneOder',name:'phoneOder'},
                        {data:'TotalOrder',name:'TotalOrder'},
                        {data:'Address',name:'Address'},
                        {data:'notes',name:'notes'},
                        {data:'Payments',name:'Payments'},
                        {data:'created_at',name:'created_at'},
                        {data:'status',name:'status'},
                        {data:'action',name:'action'}

                    ]
                });
           });

           $(document).on('click','a[href="#messages"]',function(event){


                $('#table_error').DataTable({
                    processing:true,
                    retrieve: true,
                    serverSide:true,
                    language: {
                        "url": Vietnamese
                    },
                    ajax: '{{ Route('fetch_order_error') }}',
                    columns:[
                        {data:'stt',render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {data:'codeOder',name:'codeOder'},
                        {data:'fullName',name:'fullName'},
                        {data:'phoneOder',name:'phoneOder'},
                        {data:'TotalOrder',name:'TotalOrder'},
                        {data:'Address',name:'Address'},
                        {data:'notes',name:'notes'},
                        {data:'Payments',name:'Payments'},
                        {data:'created_at',name:'created_at'},
                        {data:'status',name:'status'},
                        {data:'action',name:'action'}

                    ]
                });
            });



        });
    </script>
@endsection
