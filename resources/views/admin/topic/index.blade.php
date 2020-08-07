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
            <a href="#" class="btn btn-sm btn-success insert-topic-btn">Thêm Chủ Đề</a>
        </div>
    </div>
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
<div class="modal insert_topic" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm chủ đề</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span id="form_result"></span>
            <form id="insert_topic">
             {{ csrf_field() }}
             <div class="row">
                 <div class="col-md-12">
                     <div class="form-group">
                         <label>Tên Chủ Đề</label>
                         <input name="name" class="form-control" type="text" value="{{ old('name') }}" required>



                     </div>


                     <div class="form-group">
                         <label>Từ Khóa Meta Desc</label>
                         <textarea name="metadesc" class="form-control" rows="3" required minlength="11">{{ old('metadesc') }}</textarea>


                     </div>
                     <div class="form-group">
                         <label>Từ Khóa Meta Key</label>
                         <textarea name="metakey" class="form-control" rows="3" required minlength="11">{{ old('metakey') }}</textarea>


                     </div>
                     <div class="form-group text-center">
                         <label>Trạng Thái</label>
                         <div class="custom-control custom-switch">
                             <input type="checkbox" class="custom-control-input" name="status" id="status" >
                             <label class="custom-control-label" for="status"></label>
                         </div>

                     </div>

                     <div class="form-group text-center">
                         <button type="submit" name="ok_button" id="btn_submit" class="btn btn-success">Thêm</button>


                     </div>
                 </div>
             </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>

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
        $(document).on('click','.insert-topic-btn',function(event){
            event.preventDefault();
            $('.insert_topic').modal('show');
        });
        $(document).on('submit','#insert_topic',function(event){
            event.preventDefault();
            var url= "{{ Route('insert.topic') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                type:"POST",
                dataType:"JSON",
                data:$(this).serialize(),
                success:function(data)
                {
                    if(data.success)
                    {
                        alertify.success(data.success);
                        setTimeout(function(){
                            $("#insert_topic")[0].reset();
                            $('#table_index').DataTable().ajax.reload();



                        }, 1000);
                    }else
                    {
                        $.each(data.danger,function(key,val){
                            alertify.error(val[0]);
                        })
                    }
                }
            });
        })
    });
    </script>
@endsection
