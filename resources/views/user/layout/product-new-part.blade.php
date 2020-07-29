<div class="row my-3">
    @foreach ($productsnew as $item)

            <div class="col-md-3 my-3">
                <div class="card-deck">
                    <div class="card border-color">
                     <a> <img class="card-img-top lazy" data-src="{{ $item->image }}" alt="{{ $item->slug }}"  > </a>
                      <div class="card-body">
                        <h5 class="card-title text-center">{{ $item->name }}</h5>
                        <p class="card-text my-3 text-center">
                            <div class="text-center">
                                @if (isset($item->pricesale))
                                <div> <span> {{ number_format($item->price) }} VNĐ </span></div>
                                 <div>

                                     <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->pricesale) }} VNĐ </span>
                                     {{-- ROUND làm tròn số --}}
                                     <span style="display: inline-block; background-color: #FA5130; color: white; padding: 5px 5px;font-weight: 700;">  {{round( ( ( $item->price - $item->pricesale ) / $item->price ) * 100 ) }} % GIẢM</span>
                                 </div>
                                @else
                                <div> <span style="color: #FA5130; font-size: 1.3rem;"> {{ number_format($item->price) }} VNĐ </span> </div>

                                 @endif
                            </div>
                        </p>
                      </div>
                    </div>
                </div>
          </div>

    @endforeach
</div>
