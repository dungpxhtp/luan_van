<div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($brandsproducts as $item)

                        @if ($loop->first)

                        <div class="carousel-item active" style="width:100">
                                <img src="https://cdn3.dhht.vn/wp-content/uploads/2020/07/banner-trang-chu-orient-thang-7.jpg" class="d-block w-100" alt="{{$item->name }}" style="background-size:cover;" />
                        </div>
                        @else
                            <div class="carousel-item">
                                <img src="https://cdn3.dhht.vn/wp-content/uploads/2020/07/banner-trang-chu-orient-thang-7.jpg" class="d-block w-100" alt="{{$item->name }}"  style="background-size:cover;"/>
                            </div>
                        @endif
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</div>
