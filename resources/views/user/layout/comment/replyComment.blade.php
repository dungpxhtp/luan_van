@php
    use App\Models\commentproducts;

    $reply=commentproducts::where([['commentproducts.parentid','=',$id],['commentproducts.status','=','1']])->join('users','commentproducts.id_user','=','users.id')->select('commentproducts.*','users.name as nameuser')->orderBy('created_at','desc')->paginate(10);


@endphp
@foreach ($reply as $replyitem)
<div class="reply-comment">
    <p class="name-comment">{{ $replyitem->nameuser }}</p>
    <span class="text-comment">{{ $replyitem->commentText }}</span>
    <div class="comment-acttion">
        <a href="">Trả Lời</a>
        <span>1 tuần</span>
    </div>
</div>
@endforeach
