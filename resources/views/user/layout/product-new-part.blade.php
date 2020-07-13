<div class="row my-3">
    @foreach ($productsnew as $item)

            <div class="col-md-3 my-3">
                <div class="card-deck">
                    <div class="card border-color">
                     <a> <img class="card-img-top lazy" data-src="{{ $item->image }}" alt="{{ $item->slug }}"  > </a>
                      <div class="card-body">
                        <h5 class="card-title text-center">{{ $item->name }}</h5>
                        <p class="card-text my-3 text-center">{{ number_format($item->price) }} VNĐ</p>
                      </div>
                    </div>
                </div>
          </div>

    @endforeach
</div>
