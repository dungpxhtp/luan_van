{{ Breadcrumbs::render('account',"Tìm Kiếm : ".$keyword) }}
<div class="container">

    <div class="row my-3">
        <div class="col-md-12">
            <span style="color:#111;font-size:1.4rem;font-weight:500;">Đang Xem {{ $products->count() }} Sản Phẩm Trong Tổng Số {{ $count }} Sản Phẩm Tìm Thấy</span>
        </div>
            @if( $products->count() ==0)
                <h3 class="text-danger">
                    không có sản phẩm nào được tìm thấy
                </h3>
            @endif
        @foreach ($products as $item)

        <div class="col-md-3 my-3">
            <div class="card-deck">
                <div class="card border-color">
                <a href="{{Route('productDetail',['slug'=>$item->slug])}}" class="mh-250px"> <img class="card-img-top lazy product__img" data-src="{{ $item->image }}" src="{{ $item->image }}" alt="{{ $item->slug }}"> </a>
                <div class="card-body mt-70px">
                    <a href="{{Route('productDetail',['slug'=>$item->slug])}}" class="d-block card-title text-center product__item">{{ $item->name }}</a>
                        <div class="text-center">
                            @if (isset($item->pricesale))
                            <div> <span class="price"> {{ number_format($item->price) }} VNĐ </span></div>
                             <div>

                                 <span class="price-sales" style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->pricesale) }} VNĐ </span>
                                 {{-- ROUND làm tròn số --}}
                                 <span class="percent">  {{round( ( ( $item->price - $item->pricesale ) / $item->price ) * 100 ) }} % GIẢM</span>
                             </div>
                            @else
                            <div> <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->price) }} VNĐ </span> </div>

                             @endif
                        </div>
                </div>

                </div>
            </div>
      </div>

      @endforeach

    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
                {{ $products->links() }}
        </div>
    </div>


</div>
