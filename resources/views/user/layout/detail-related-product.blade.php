@php
    use App\Models\products;
    $products_related=products::where([['status','=','1'],['id_gendercategoryproducts','=',$id],['id','<>',$id_products]])->orderBy('created_at','desc')->distinct()->get();
@endphp
@if (count($products_related))

    <div class="row" >
        <div class="col-md-12 text-center">
            <h3>Sản Phẩm Liên Quan Đối Tượng</h3>
        </div>
    </div>
    <div class="row my-3"  data-aos="fade-down"
    data-aos-easing="linear"
    data-aos-duration="1500">
        <div class="owl-carousel">
            @foreach ($products_related as $item)
            <div>
                <div class="card" style="min-height: 480px">
                 <a href="{{Route('productDetail',['slug'=>$item->slug])}}">   <img class="card-img-top owl-lazy" src="{{ $item->image }}" data-src="{{ $item->image }}" alt="{{ $item->slug }}" width="170px"> </a>
                    <div class="card-body" style="height: 100px">
                        <h5 class="card-title text-center">{{ $item->name }}</h5>
                        <div class="text-center">
                            @if (isset($item->pricesale))
                            <div> <span class="price"> {{ number_format($item->price) }} VNĐ </span></div>
                             <div>

                                 <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->pricesale) }} VNĐ </span>
                                 {{-- ROUND làm tròn số --}}
                                 <span style="display: inline-block; background-color: #FA5130; color: white; padding: 5px 5px;font-weight: 700;">  {{round( ( ( $item->price - $item->pricesale ) / $item->price ) * 100 ) }} % GIẢM</span>
                             </div>
                            @else
                            <div> <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->price) }} VNĐ </span> </div>

                             @endif
                        </div>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

@endif

