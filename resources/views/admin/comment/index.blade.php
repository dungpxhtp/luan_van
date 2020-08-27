@extends('admin.layoutsite')
@section('title')
Quản Lý Bình Luận
@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Bình Luận</li>
               <li class="breadcrumb-item active">Quản Lý  Bình Luận Chưa Duyệt</li>

            </ol>
    </div>

</nav>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table_index">
                    <thead>
                      <tr>

                        <th scope="col">#</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian bình luận</th>
                        <th scope="col">Sản phẩm bình luận</th>
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
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Bình Luận</li>
                  <li class="breadcrumb-item active">Quản Lý  Bình Luận Đã Duyệt</li>
            </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table_check">
                    <thead>
                      <tr>

                        <th scope="col">#</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian bình luận</th>
                        <th scope="col">Sản phẩm bình luận</th>
                        <th scope="col">Chức Năng</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</nav>
@endsection
@section('script')
    <script>
      $(document).ready(function(){
        var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";
        //loading table
        $('#table_index').DataTable({
            processing:true,
            serverSide:true,
            language: {
                "url": Vietnamese
            },
            ajax: '{{ Route('comment.fetchindex') }}',
            columns:[
                {data:'stt',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data:'nameUser',name:'nameUser'},
                {data:'commentText',name:'commentText'},
                {data:'status',name:'status'},
                {data:'created_at',name:'created_at'},
                {data:'products',name:'products'},
                {data:'chucnang',name:'chucnang'},
            ]
        });
        $('#table_check').DataTable({
            processing:true,
            serverSide:true,
            language: {
                "url": Vietnamese
            },
            ajax: '{{ Route('comment.fecthindexcheck') }}',
            columns:[
                {data:'stt',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data:'nameUser',name:'nameUser'},
                {data:'commentText',name:'commentText'},
                {data:'status',name:'status'},
                {data:'created_at',name:'created_at'},
                {data:'products',name:'products'},
                {data:'chucnang',name:'chucnang'},
            ]
        });
        //thay đổi trạng thái
        $(document).on('click','.update_status',function(event){
            event.preventDefault();
            var id= $(this).attr('href');
            let url ="{{ Route('comment.updateStatus',':id') }}";
            url =url.replace(':id',id);
            $.ajax({
                url:url,
                type:'GET',
                success:function(data)
                {
                        if(data.success)
                        {
                        alertify.success(data.success);
                        setTimeout(function(){
                            $('#table_index').DataTable().ajax.reload();



                        }, 1000);
                    }else
                    {
                        alertify.error(data.danger);

                    }
                }
            });
        });
        $(document).on('click','.delete',function(event){
            event.preventDefault();
            var id= $(this).attr('href');
            let url="{{ Route('comment.delete',':id') }}";
            url=url.replace(':id',id);
            $.ajax({
                url:url,
                type:"GET",
                success:function(data)
                {
                    if(data.success)
                    {
                    alertify.success(data.success);
                    setTimeout(function(){
                        $('#table_index').DataTable().ajax.reload();
                        $('#table_check').DataTable().ajax.reload();



                    }, 1000);
                }else
                {
                    alertify.error(data.danger);

                }
                }
            });
        });

    });
    </script>
@endsection
