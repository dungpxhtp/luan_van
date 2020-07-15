<div class="row my-3 justify-content-center">
    @foreach ($brandsproducts as $item)


    <div class="col-xs-4 margin-item  ">
       <a href="{{ Route('brands_products.thuong-hieu',['slug'=>$item->slug]) }}" class="">
           <img class="lazy border-brands-product"  src="{{ $item->image }}" data-src="{{ $item->image }}" alt="{{ $item->slug }}" width="170px" height="102px"/>
        </a>
    </div>
    @endforeach
</div>
