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
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Hãng</li>
             {{-- <li class="breadcrumb-item active">Sản Phẩm </li> --}}

            </ol>
    </div>

</nav>
@include('admin.brandproducts.modules.tableindex')
@includeIf('admin.products.modules.message')
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#thongbao").modal('show');
        });
    </script>

@endsection
