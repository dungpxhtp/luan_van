@extends('admin.layoutsite')
@section('title')
Quản Lý Bài Viết
@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Tin Tức</li>
               <li class="breadcrumb-item active">Quản Lý Bài Viết</li>

            </ol>
    </div>

</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ Route('insert.getPost') }}" class="btn btn-sm btn-success">Thêm Bài Viết</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="table_index">
                    <thead>
                      <tr>

                        <th scope="col">#</th>
                        <th scope="col">Chủ Đề Bài Viết</th>
                        <th scope="col">Đề Tài</th>
                        <th scope="col">Thời Gian Tạo</th>
                        <th scope="col">Nhân viên cập nhật</th>
                        <th scope="col">Nhân viên tạo bài</th>
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
            ajax: '{{ Route('fetchindex.post') }}',
            columns:[
                {data:'stt',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data:'nametopic',name:'nametopic'},
                {data:'title',name:'title'},
                {data:'image',name:'image'},
                {data:'update_by',name:'update_by'},
                {data:'create_by',name:'create_by'},
                {data:'action',name:'action'},






            ]
        });
        //thay đổi trạng thái
        $(document).on('click','.update_status',function(event){
            event.preventDefault();
            var id= $(this).attr('href');
            let url ="{{ Route('update_status.post',':id') }}";
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
            let url="{{ Route('delete_news.post',':id') }}";
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
