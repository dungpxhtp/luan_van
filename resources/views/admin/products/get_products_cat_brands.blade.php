@extends('admin.layoutsite')
@section('title')
    Quản Lý Sản Phẩm Trong Loại
@endsection
@section('head')

@endsection
@section('main')
<nav aria-label="Page breadcrumb" class="my-3">
    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item breadcrumb-customer"><i class="fas fa-tachometer-alt"></i>Danh Sách Hãng</li>

             <li class="breadcrumb-item active">{{ $NameBrand }} </li>
             <li class="breadcrumb-item active">
            {{ $NameCate }}
                 </li>

            </ol>
    </div>

</nav>
@include('admin.products.modules.table_get_products_cat_brands')
@endsection
