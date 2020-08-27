@php
    use App\Models\products;
    $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$id_gendercategoryproducts]])->orderBy('created_at','desc')->take(4)->get();
@endphp
<div class="row my-3">
    @if (count($products)>0)
        @foreach ($products as $item)

        <div class="col-md-3 my-3">
            <div class="card-deck">
                <div class="card border-color">
                <a href="{{Route('productDetail',['slug'=>$item->slug])}}" class="mh-250px"> <img class="card-img-top lazy product__img" data-src="{{ $item->image }}" alt="{{ $item->slug }}"> </a>
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
    @else
           <div class="col-md-12">
            <p class="text-center ">Chưa có sản phẩm đối tượng này</p>
           </div>
    @endif
</div>
