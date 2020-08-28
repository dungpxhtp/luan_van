@foreach ($post as $item)
   <div class="row my-3">
        <div class="col-md-12">
            <div class="box-post">
                    <p class="date-post">
                        <span style="display: block;margin-top:3px;">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                        </span>
                    </p>

                    <a class="title-post text-center" href="{{ Route('postdetail',['slug'=>$item->slug]) }}">
                        {{ $item->title }}
                    </a>

                   <div>
                  <a href="{{ Route('postdetail',['slug'=>$item->slug]) }}"> <img src="{{ $item->image }}" alt="{{ $item->slug }}" style="width:100%"> </a>
                    </div>
                    <p class="text-description my-3">
                        {!! \Illuminate\Support\Str::limit(strip_tags($item->detail), $limit = 100, $end = '...') !!}
                    </p>
                    <div class="read-more d-flex justify-content-end">
                        <a href="{{ Route('postdetail',['slug'=>$item->slug]) }}" class="btn btn-sm btn-info">Xem Thêm</a>

                    </div>
            </div>
        </div>
   </div>

@endforeach
<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        {{ $post->links() }}
    </div>
</div>
