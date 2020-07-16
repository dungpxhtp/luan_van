
<div class="row my-2">

    <h6 class="text-span" style="margin-top: 10px;"> {{ $comment->count() }} Bình Luận</h6>
@foreach ($comment as $item)



    <div class="col-md-12 my-2">
        @if ($item->parentid==0)
        <h5 class="name-comment">{{ $item->nameuser }}</h5>
        <span class="text-comment">{{ $item->commentText }}</span>
        <div class="comment-acttion">
            <a href="" class="btn-reply">Trả Lời</a>
            <span>{{ $item->created_at }}</span>
        </div>
        @endif


        @foreach ($comment as $itemreply)
                @if ($itemreply->parentid == $item->id)
                <div class="reply-comment">
                    <p class="name-comment">{{ $itemreply->nameuser }}</p>
                    <span class="text-comment">{{  $itemreply->commentText }}</span>
                    <div class="comment-acttion">
                        <a href="" class="btn-reply">Trả Lời</a>
                        <span>{{ $itemreply->created_at }}</span>
                    </div>
                </div>
                @endif
        @endforeach
    </div>



@endforeach

</div>
<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        {!! $comment->links() !!}
    </div>
</div>

