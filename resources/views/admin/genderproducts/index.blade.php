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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Loại Đồng Hồ</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
<div class="button-save row my-3">
    <div class="col">
        <a class="btn btn-primary btn-sm btn_add">
            <i class="fas fa-plus"></i> <span class="text-btn">
                Thêm Loại Đồng Hồ
            </span>
        </a>
    </div>

</div>
@include('admin.genderproducts.modules.tableindex')
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

           <h4 class="modal-title">Thêm</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>

           </div>
           <div class="modal-body">
            <span id="form_result"></span>
                   <form id="insert_gender">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tên Hãng Đồng Hồ</label>
                                <input name="name" class="form-control" type="text" value="{{ old('name') }}">
                             @if ($errors->has('name'))
                             <span class="text-danger">{{ $errors->first('name') }}</span>
                             @endif


                            </div>


                            <div class="form-group">
                                <label>Từ Khóa Meta Key</label>
                                <textarea name="metakey" class="form-control" rows="3">{{ old('metakey') }}</textarea>
                             @if ($errors->has('metakey'))
                             <span class="text-danger">{{ $errors->first('metakey') }}</span>
                             @endif

                            </div>
                            <div class="form-group">
                                <label>Từ Khóa Meta Key</label>
                                <textarea name="metadesc" class="form-control" rows="3">{{ old('metakey') }}</textarea>
                             @if ($errors->has('metadesc'))
                             <span class="text-danger">{{ $errors->first('metadesc') }}</span>
                             @endif

                            </div>
                            <div class="form-group text-center">
                                <label>Trạng Thái</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="status" >
                                    <label class="custom-control-label" for="status"></label>
                                </div>

                            </div>

                            <div class="form-group text-center">
                                <button type="button" name="ok_button" id="btn_submit" class="btn btn-success">Thêm</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>


                            </div>
                        </div>
                    </div>
                </form>
           </div>
        </div>
       </div>
   </div>
@endsection
@section('script')
    <script>
        $(document).on('click','.btn_add',function(event){
            event.preventDefault();
            $('#formModal').modal('show');
        });
        $('#btn_submit').click(function(event){
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url= '{{ Route('post_add_gendercategoryproducts') }}';
            console.log(url);
            $.ajax({
                url:url,
                type:'POST',
                data:$('#insert_gender').serialize(),
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'JSON',
                success:function(data){
                    var html = '';
                    if(data.errors)
                    {
                    html = '<div class="alert alert-danger">';

                    html += '<p>' + data.errors + '</p>';

                    html += '</div>';
                    }
                    if(data.success)
                    {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#insert_gender')[0].reset();
                    $('#table_index').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });
    </script>
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
                    ajax: '{{ Route('fetchgendercategoryproducts') }}',
                    columns:[
                        {data:'id',name:'id'},
                        {data:'name',name:'name'},

                        {data:'status_brandproduct',name:'status_brandproduct'},
                        {data:'created_at_brandproduct',name:'created_at_brandproduct'},

                        {data:'action',name:'action',orderable: false},




                    ]
                });
            })
            $(document).on('click','.update_status',function(event){
                event.preventDefault();
                var id = $(this).attr("href");
                let url="{{ Route('update_status_gendercategoryproducts',':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url :url,
                    type:"GET",
                    dataType:"json",
                    jsonpCallback: "index",
                    success:function(data)
                    {
                        alert(data);
                    setTimeout(function(){
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
                let url="{{ Route('destroy_gendercategoryproducts',':id') }}";
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
