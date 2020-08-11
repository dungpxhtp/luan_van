<div class="row my-3">
    <div class="col-md-12">
        Đang Xem {{ $products->count() }} Sản Phẩm
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        {!! $products->render() !!}
    </div>
    @foreach ($products as $item)

    <div class="col-md-3 my-3">
        <div class="card-deck">
            <div class="card border-color">
             <a href="{{Route('productDetail',['slug'=>$item->slug])}}"> <img class="card-img-top lazy" data-src="{{ $item->image }}" alt="{{ $item->slug }}"  src="{{ $item->image }}"> </a>
              <div class="card-body">
                <h5 class="card-title text-center">{{ $item->name }}</h5>
                <div class="text-center">
                    @if (isset($item->pricesale))
                    <div> <span class="price"> {{ number_format($item->price) }} VNĐ </span></div>
                     <div>

                         <span class="price-sales" style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->pricesale) }} VNĐ </span>
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
  </div>

  @endforeach

</div>
