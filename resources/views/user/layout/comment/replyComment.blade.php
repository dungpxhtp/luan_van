@section('style')
    <style>
        .btn-reply{
            background-color: brown;
            color: white;
        }
        .btn-reply:focus,
        .btn-reply:hover + .box-reply{
            display: block;
        }
    </style>
@endsection
<div class="row my-2">

    <h6 class="text-span" style="margin-top: 10px;"> {{ $comment->count() }} Bình Luận</h6>
@foreach ($comment as $item)



    <div class="col-md-12 my-2">
        @if ($item->parentid==0)
        <h5 class="name-comment">{{ $item->nameuser }}</h5>
        <span class="text-comment">{{ $item->commentText }}</span>
        <div class="comment-acttion">
            <button  data-id-parentid="{{ $item->id }}" class="btn-reply btn btn-sm ">Trả Lời</button>
            <span>{{ $item->created_at }}</span>
            <div class="row box-reply my-2 " style="display: block">

                   <div class="col-md-8 my-2">
                    <span class="cancel_cmt btn btn-sm btn-danger"> x </span>

                    <form>
                        <textarea name="text-comment"  cols="30" rows="3" required minlength="20" style="width: 100% ;border:none;">@ {{ $item->nameuser }} : </textarea>
                        <button class="btn btn-sm btn-warning">
                            Gửi
                        </button>
                    </form>
                   </div>

            </div>
        </div>
        @endif


        @foreach ($comment as $itemreply)
                @if ($itemreply->parentid == $item->id)
                <div class="reply-comment">
                    <p class="name-comment">{{ $itemreply->nameuser }}</p>
                    <span class="text-comment">{{  $itemreply->commentText }}</span>
                    <div class="comment-acttion">
                        <a href=""  data-id-parentid="{{ $item->id }}" class="btn-reply">Trả Lời</a>
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




