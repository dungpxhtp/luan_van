@extends('user.layoutsite')
@section('title')
    Trang Chủ
@endsection
@section('style')

@endsection
@section('meta')
<meta name="description" content="Website Bán Đồng Hồ Uy Tính Nhất Việt Nam" />
<meta name="keywords" content="website dong ho , dong ho uy tinh , dong ho casio , dong ho " />
<meta name="robots" content="index,follow" />


@endsection
@section('banner')
@includeIf('user.layout.silder')
@endsection
@section('main')

    {{--  đối tượng  --}}
    @if (count($gendercategoryproducts) > 0)
            @foreach ($gendercategoryproducts as $item)
                <div class="clearfix my-3">
                    <div class="container"  data-aos="fade-up">
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
        <div class="container" data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1500">
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
            <div class="container" data-aos="fade-up"
            data-aos-anchor-placement="top-bottom">
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
