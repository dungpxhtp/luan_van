@extends('admin.layoutsite')
@section('title')
    Quản Lý Số Lượng Sản Phẩm
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main')
<nav aria-label="Page breadcrumb">
    <div class="container">
            <ol class="breadcrumb">
                  <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Quản Lý Sản Phẩm</li>
               <li class="breadcrumb-item active">Quản Lý Số Lượng Sản phẩm</li>

            </ol>
    </div>

</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
           <div class="table-responsive-sm">
            <table class="table" id="table_index">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Sản Phẩm</th>
                    <th scope="col">Mã</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Số Lượng Sản Phẩm Còn</th>
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

<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nhập Số Lượng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-submit">
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Thêm Số Lượng</label>
                  <div class="col-sm-10">
                    <input type="number" required min="1" name="quantity"  class="form-control quantity" placeholder="Nhập Số Lượng Thêm">
                    <input type="hidden" name="id" class="id">
                  </div>
                </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
          <button type="submit" class="btn btn-primary btn-submit">Thêm</button>
        </div>
    </form>
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
                language: {
                    "url": Vietnamese
                },
                ajax: '{{ Route('fetch_view_product_quantity') }}',
                columns:[
                    {data:'stt',render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data:'name',name:'name'},
                    {data:'code',name:'code'},
                    {data:'image',name:'image'},
                    {data:'quantity',name:'quantity'},
                    {data:'action',name:'action'},








                ]
            });
            $(document).on('click','.update_quantity',function(event){
                $('.quantity').val('');
                event.preventDefault();
                var id=$('.id').val('');
                var id=$(this).attr('href');
                $('.modal').modal('show');
                var id=$('.id').val(id);


            });
            $(document).on('submit','.form-submit',function(event){
                event.preventDefault();
                var id = $('.id').val();
                console.log(id);
                let url ="{{ Route('update_quantity',':id') }}";
                url=  url.replace(':id',id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:url,
                    type:"POST",
                    data:$(this).serialize(),
                    success:function(data){
                            if(data.success)
                                {
                                alertify.success(data.success);
                                setTimeout(function(){
                                    $('#table_index').DataTable().ajax.reload();
                                    $('.modal').modal('hide');



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
@endsection>
