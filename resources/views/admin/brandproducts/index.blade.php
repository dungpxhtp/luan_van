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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Hãng Đồng Hồ</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
<div class="button-save row my-3">
    <div class="col">
        <a class="btn btn-primary btn-sm " href="{{ Route('add_brandproduct') }}">
            <i class="fas fa-plus"></i> <span class="text-btn">
                Thêm Hãng Đồng Hồ
            </span>
        </a>
    </div>

</div>
@include('admin.brandproducts.modules.tableindex')
@includeIf('admin.products.modules.message')

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"></h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Bạn có chắc chắn muốn xóa dữ liệu này?
            </h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title"></h4>
           </div>
           <div class="modal-body">
            <span id="form_result"></span>
            <div class="row">
                    <div class="col">
                        <form method="post" id="sample_form" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                              <label class="control-label col-md-4" >Tên : </label>
                              <div class="col">
                               <input type="text" name="name" id="first_name" class="form-control" />
                              </div>
                             </div>
                             <div class="form-group">
                              <label class="control-label col-md-4">Mã Hàng : </label>
                              <div class="col">
                               <input type="text" name="code" id="last_name" class="form-control" />
                              </div>
                              <div class="form-group">
                                <label>Chọn Ảnh Đại Diện</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="far fa-images"></i>Chọn Ảnh
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="filepath" readonly value="{{old('filepath')}}" >
                                  </div>
                                  <img id="holder" style="margin-top:15px;max-height:100px;" src="">
                                  @if ($errors->has('filepath'))
                                  <span class="text-danger">{{ $errors->first('filepath') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <label>Chi Tiết Đồng Hồ</label>
                                <textarea id="my-editor" name="detail" class="form-control">
                                    {{ old('detail') }}
                                </textarea>

                             </div>
                            <div class="form-group text-center">
                                <label>Trạng Thái</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                    <label class="custom-control-label" for="status"></label>
                                </div>

                               </div>
                             </div>
                                  <br />
                                  <div class="form-group" align="center">
                                   <input type="hidden" name="action" id="action" value="Add" />
                                   <input type="hidden" name="hidden_id" id="hidden_id" />
                                   <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                                  </div>
                           </form>
                    </div>
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
                    ajax: '{{ Route('ajaxbrandproduct') }}',
                    columns:[
                        {data:'stt',render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {data:'name',name:'name'},
                        {data:'code',name:'code'},
                        {data:'status_brandproduct',name:'status_brandproduct'},
                        {data:'soluong',name:'soluong'},

                        {data:'created_at_brandproduct',name:'created_at_brandproduct'},
                        {data:'stt',name:'stt'},

                        {data:'image_brands',name:'image_brands',orderable:false},
                        {data:'action',name:'action',orderable: false},




                    ]
                });
            })
            $(document).on('click','.update_status',function(event){
                event.preventDefault();
                var id = $(this).attr("href");
                let url="{{ Route('update_status.brandproducts',':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url :url,
                    type:"GET",
                    dataType:"json",
                    jsonpCallback: "index",
                    success:function(data)
                    {
                    setTimeout(function(){
                        alertify.success(data.success);
                        $('#table_index').DataTable().ajax.reload();

                    },1000);
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
                let url="{{ Route('destroy.brandproducts',':id') }}";
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
                            alertify.success(data);
                        }, 1000);
                    }

                });
            })

        </script>




@endsection
