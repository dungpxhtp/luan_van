@section('style')
    <style>
        .btn-reply{
            background-color: brown;
            color: white;
        }
        .btn-reply:active + .box-reply{
            display: block;
        }
        .text-comment{
            margin: 5px 20px;
        }
    </style>
@endsection
<div class="row my-2">

    <h6 class="text-span" style="margin-top: 10px;"> {{ $comment->count() }} Bình Luận</h6>
@foreach ($comment as $item)



    <div class="col-md-12 my-2">
        @if ($item->parentid==0)
        <h5 class="name-comment">{{ $item->nameuser }}</h5>
        <p class="text-comment">{{ $item->commentText }}</p>
        <div class="comment-acttion">
            <button  value="{{ $item->id }}" class="btn-reply btn btn-sm ">Trả Lời</button>
            <span style="display: block;"><i class="far fa-clock"></i>{{ $item->created_at }}</span>
            <div class="row box-reply my-2  {{ $item->id }}" style="display: none">

                   <div class="col-md-8 my-2">
                    <button value="{{ $item->id }}" class="cancel_cmt btn btn-sm btn-danger"> x </button>

                    <form class="form-reply-comment"  action="{{ Route('replyCommentProduct',['id_products'=>$item->id_product,'parentid'=>$item->id]) }}">
                        <textarea name="text-comment" class="text"  cols="30" rows="3" required minlength="20" maxlength="200" style="width: 100% ;border:none;" >@ {{ $item->nameuser }} : </textarea>
                        <h6 class="pull-right show" style="margin-top: 10px;"></h6>

                        <button type="submit" class="btn btn-sm btn-warning ">
                            Gửi Bình Luận
                        </button>
                    </form>
                   </div>

            </div>
        </div>
        @endif


        @foreach ($comment as $itemreply)
                @if ($itemreply->parentid == $item->id)
                <div class="reply-comment">
                    <h5 class="name-comment">{{ $itemreply->nameuser }}</h5>
                    <span class="text-comment">{{  $itemreply->commentText }}</span>
                    <div class="comment-acttion">
                        <span><i class="far fa-clock"></i> {{ $itemreply->created_at }}</span>
                    </div>
                </div>
                @endif
        @endforeach
    </div>

<div class="my-2"></div>

@endforeach

</div>
<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        {!! $comment->links() !!}
    </div>
</div>




    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            function reloadComment(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('#showcomment').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            };
            $('.btn-reply').click(function(e){
                $('.box-reply').hide();
            $idComent=$(this).val();
                $("."+$idComent+"").show();
            });
            $('.cancel_cmt').click(function(e){
                $idComent=$(this).val();
                $("."+$idComent+"").hide();
            })
            $('.form-reply-comment').submit(function(e){
                e.preventDefault();
                var href =$(this).attr('action');
                var locationhref=window.location.href;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:href,
                    type:"POST",
                    data:$(this).serialize(),
                    contentType:'application/x-www-form-urlencoded;     charset=UTF-8' ,
                    dataType:"JSON",
                    success:function(data){
                        if(data.success)
                        {
                            alert(data.success);
                             setTimeout(function(){


                                reloadComment(locationhref);
                            },2000);

                        }else
                        {
                            alert(data.error);
                        }
                    }
                });


            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/myJs/demsokitu_reply_comment.js') }}">
    </script>

