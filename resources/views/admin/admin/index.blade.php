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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Nhân Viên</li>

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
                        <th scope="col">Tên Nhân Viên</th>
                        <th scope="col">Email </th>
                        <th scope="col">Số Điện Thoại</th>
                        <th scope="col">Chức Vụ</th>
                        <th scope="col">Tình Trạng</th>
                        <th scope="col">Người Tạo</th>
                        <th scope="col">Người Cập Nhật</th>
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
{{--  modal update  --}}
<div class="modal update_topic" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chỉnh Sửa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span id="form_result"></span>
            <form id="update_topic">
             {{ csrf_field() }}
             <div class="row">
                 <div class="col-md-12">
                     <div class="form-group">
                         <label>Tên đầy đủ</label>
                         <input name="fullname" class="form-control" type="text" value="{{ old('fullname') }}" required>
                        <input type="hidden" name="id_update" >


                     </div>


                     <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" type="email" value="{{ old('fullname') }}" required>


                     </div>
                     <div class="form-group">
                         <label>Số điện thoại</label>
                         <input name="phone" class="form-control" type="number" maxlength="11" value="{{ old('fullname') }}" required>

                     </div>
                     <div class="form-group">
                         <label>Chức Vụ</label>
                         <select class="form-control" name="access">
                            <option value="0">Nhân Viên</option>
                            <option value="1">Người Quản Lý</option>
                          </select>
                     </div>


                     <div class="form-group text-center">
                         <button type="submit" name="ok_button"  class="btn btn-success">Chỉnh Sửa</button>
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
            $('#table_index').DataTable({
                processing:true,
                serverSide:true,
                language:{
                    "url":Vietnamese
                },
                ajax:'{{ Route('admin.fetchIndex') }}',
                columns:[
                    {data:'fullName',name:'fullName'},
                    {data:'email',name:'email'},
                    {data:'phone',name:'phone'},
                    {data:'access',name:'access'},
                    {data:'status',name:'status'},
                    {data:'nameAdminCreated','name':'nameAdminCreated'},
                    {data:'update_by','name':'update_by'},
                    {data:'action',name:'action'},
                ]
            });
            //Cập nhật
            $(document).on('click','.update_status',function(event){
                event.preventDefault();
                var id= $(this).attr('href');
                let url ="{{ Route('admin.updateStatus',':id') }}";
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
            //Chỉnh sửa

                    //chỉnh sữa nhân viên
        $(document).on('click','.edit',function(event){
            event.preventDefault();
            var id=$(this).attr('href');
            let url ="{{ Route('admin.find',':id') }}";

            url =url.replace(':id',id);
            $.ajax({
                url:url,
                type:"GET",
                success:function(data)

                {
                    console.log(data);
                     if(data.success)
                    {
                        var response=data.success;

                    $('input[name="id_update"]').val(response.id);
                    $('input[name="fullname"]').val(response.fullname);
                    $('input[name="email"]').val(response.email);
                    $('input[name="phone"]').val(response.phone);
                    $('select[name="access"]').val(response.access);
                    $('.update_topic').modal('show');
                    }
                }
            });
        });
        // update
        $(document).on('submit','#update_topic',function(event){
            event.preventDefault();
            var id=$('input[name="id_update"]').val();
            let url = "{{ Route('update.topic',':id') }}";
            url=url.replace(':id',id);
            $.ajax({
                url:url,
                type:"POST",
                dataType:"JSON",
                data:$(this).serialize(),
                success:function(data){
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
