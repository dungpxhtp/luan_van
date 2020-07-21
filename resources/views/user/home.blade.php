@extends('user.layoutsite')
@section('title')
    Trang Chủ
@endsection
@section('main')
    @includeIf('user.layout.silder')
    {{--  đối tượng  --}}
    @if (count($gendercategoryproducts) > 0)
            @foreach ($gendercategoryproducts as $item)
                <div class="clearfix my-3">
                    <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center ">
                                    <h3 class="title-product text-uppercase">
                                        <span class="span-title">{{ $item->name }}</span>
                                    </h3>
                                </div>
                            </div>
                            @includeIf('user.layout.home-part',['id_gendercategoryproducts'=>$item->id])
                    </div>
                </div>
            @endforeach
    @endif
    {{--  end đối tượng  --}}
    {{--  Thương Hiệu Products  --}}
    <div class="clearfix my-3">
        <div class="container">
            <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="title-brands text-uppercase">
                            <span class="span-title-brands">  thương hiệu đồng hồ</span>
                          </h3>
                    </div>
            </div>
                    @includeIf('user.layout.brands-part')
        </div>
    </div>
    {{--  end thuong hieu products  --}}
    <div class="clearfix my-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="title-product-news title-brands text-uppercase"> <span class="span-title-brands">đồng hồ mới nhất</span></h3>
                    </div>
                </div>
                    @includeIf('user.layout.product-new-part')
            </div>
    </div>
@endsection
@section('script')

@endsection
