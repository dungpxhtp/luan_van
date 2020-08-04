@extends('admin.layoutsite')
@section('title')
Quản Lý Chủ Đề
@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Tin Tức</li>
               <li class="breadcrumb-item active">Quản Lý Chủ Đề</li>

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
                        <th scope="col">Nhân viên tạo </th>
                        <th scope="col">Đề Tài</th>
                        <th scope="col">Thời Gian Tạo</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Chức năng</th>

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
            ajax: '{{ Route('fetchindex') }}',
            columns:[
                {data:'stt',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {data:'nameadmin',name:'nameadmin'},
                {data:'name',name:'name'},
                {data:'created_at',name:'created_at'},
                {data:'status',name:'status'},
                {data:'action',name:'action'},






            ]
        });
        //thay đổi trạng thái
        $(document).on('click','.update_status',function(event){
            event.preventDefault();
            var id= $(this).attr('href');
            let url ="{{ Route('update_status',':id') }}";
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
            let url="{{ Route('delete_topic',':id') }}";
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
        $(document).on('click','.edit',function(event){
            event.preventDefault();
            console.log('ok');
        });
    });
    </script>
@endsection
