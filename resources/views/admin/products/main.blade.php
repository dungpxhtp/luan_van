@extends('admin.layoutsite')
@section('title')
    Sản Phẩm
@endsection
@section('head')

@endsection
@section('main')
@includeIf('admin.public.template.breadcurmb', ['breadcrumb' => 'Danh Sách Hãng'])

    @include('admin.products.modules.pagination')

@endsection
