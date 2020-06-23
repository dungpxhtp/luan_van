@extends('admin.layoutsite')
@section('title')
    Sản Phẩm
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
    @include('admin.products.modules.pagination')
</nav>
@endsection
