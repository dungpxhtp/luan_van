@extends('admin.layoutsite')
@section('title')
    Sản Phẩm
@endsection
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@endsection
@section('main')

<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Loại {{ $getNameCate}}</li>
            </ol>
    </div>
    <div class="container">
       <div id="st_message"></div>
    </div>
@if (count($getCate) != 0 )
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">



                <div class="card" style="width: 18rem;">
                    <div class="card-header text-center">
                      Loại
                    </div>
                    <ul class="list-group list-group-flush">


                        @foreach ($getCate as $item)
                        <li class="list-group-item"><a href="{{ Route('get_products_cat_brands',['id_brandproducts'=>$getId_brandproducts,'id_cate'=>$item->slug]) }}">{{ $item->name }}</a></li>

                        @endforeach


                    </ul>
                  </div>
              </div>
        </div>
    </div>
@endif
</nav>
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Sản Phẩm Thuộc Hãng {{ $getNameCate }}</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
<div class="button-save row my-3">
    <div class="col">
        <a class="btn btn-primary btn-sm " href="{{ Route('getSaveProducts') }}">
            <i class="fas fa-plus"></i> <span class="text-btn">
                Thêm Sản Phẩm
            </span>
        </a>
    </div>

</div>
<div id="table_data">
    @include('admin.products.modules.tablebrands')
</div>
    @includeIf('admin.products.modal.modalproductbrands')
    @includeIf('admin.products.modules.message')

@endsection
@section('script')
    <script>
        $(document).unbind('click','.btn-off-status').on('click','.btn-off-status',function(e){
            e.preventDefault();
            var url= $(this).attr('href');
            var r=confirm("Bạn Có Muốn Cập Nhật Lại Trạng Thái");
            if(r==true)
            {
                $.ajax({
                    url:url,
                    type:"GET",
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        var nameProduct=data.data.name;
                        $("#st_message").html("<p class='alert alert-success'>Cập Nhật Trạng Thái Sản Phẩm "+nameProduct+" </p>");
                        window.setTimeout(function(){location.reload()},2000)

                    }
                });
            }



        });




    </script>

    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
        });
    </script>

@endsection

