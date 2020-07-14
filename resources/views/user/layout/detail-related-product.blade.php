@php
    use App\Models\products;
    $products_related=products::where([['status','=','1'],['id_brandproducts','=',$id]])->orderBy('created_at','desc')->take(8)->get();
@endphp
@if (count($products_related))
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>Sản Phẩm Liên Quan</h3>
        </div>
    </div>
    <div class="row my-3">
        <div class="owl-carousel">
            @foreach ($products_related as $item)
            <div>
                <div class="card">
                 <a href="{{Route('productDetail',['slug'=>$item->slug])}}">   <img class="card-img-top owl-lazy" src="{{ $item->image }}" data-src="{{ $item->image }}" alt="{{ $item->slug }}" width="170px" height="150px"> </a>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $item->name }}</h5>
                        <p class="card-text my-3 text-center">{{ number_format($item->price) }} VNĐ</p>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
    </div>

@endif

