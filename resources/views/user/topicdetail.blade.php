@extends('user.layoutsite')
@section('meta')
    <meta property="og:url"           content="{{ Route('postdetail',['slug'=>$postdetail->slug]) }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $postdetail->title }}" />
    <meta property="og:description"   content="{{ $postdetail->metaDesc }}" />
    <meta property="og:image"         content="{{ $postdetail->image }}" />
    <meta property="fb:admins" content="3417082331657785"/>

@endsection
@section('title')
    {{ $postdetail->title }}
@endsection
@section('main')
    <div class="row">

            <div class="col-md-12 d-flex justify-content-center">
                <div id="loading" style="display:none">
                    <img src="https://kiemtiencenter.com/wp-content/uploads/2018/08/loading-2.gif" alt="Loading..."/>
                </div>
            </div>
        </div>
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center ">
                    <h3 class="title-product text-uppercase">
                        <span class="span-title"> {!! \Illuminate\Support\Str::limit(strip_tags($postdetail->title), $limit = 30, $end = '...') !!}</span>
                    </h3>
                </div>
            </div>
    </div>
    <div class="clearfix my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                 <img src="   {{ $postdetail->image }}" alt="{{ $postdetail->slug }}" width="100%">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12 text-center">
                                    <h2>{{ $postdetail->title }}</h2>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-12">


                                <p>
                                    {!! $postdetail->detail !!}
                                </p>

                            </div>
                        </div>
                        <div class="row-my-3" style="margin-top:20px;">
                            <div class="col-md-12 d-flex justify-content-center">
                                <span>   Bạn Có Thấy Bài Viết Này Hữu Ích Không</span>
                                <div id="fb-root"></div>
                                <script>
                                    window.fbAsyncInit = function() {
                                      FB.init({
                                        appId      : '3417082331657785',
                                        xfbml      : true,
                                        version    : 'v7.0'
                                      });
                                      FB.AppEvents.logPageView();
                                    };

                                    (function(d, s, id){
                                       var js, fjs = d.getElementsByTagName(s)[0];
                                       if (d.getElementById(id)) {return;}
                                       js = d.createElement(s); js.id = id;
                                       js.src = "https://connect.facebook.net/vi_VN/sdk.js";
                                       fjs.parentNode.insertBefore(js, fjs);
                                     }(document, 'script', 'facebook-jssdk'));

                                     FB.ui({
                                        method: 'share',
                                        href: 'https://developers.facebook.com/docs/',
                                      }, function(response){});
                                  </script>

                                <!-- Your like button code -->

                            </div>
                            <div class="fb-like"
                            data-href="{{ Route('postdetail',['slug'=>$postdetail->slug]) }}"
                            data-width="450"
                            data-layout="button_count"
                            data-action="like"
                            data-size="small"
                            data-share="true">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="row box-topic">
                            <div class="col-md-12 text-center">
                                <h3 class="title-topic">Danh Mục Tham Khảo</h3>
                            </div>
                            <div class="col-md-12 my-2">

                                    @foreach ($topic as $item)
                                    <div class="box-description-topic my-2">
                                        <i class="fas fa-chevron-right"></i>
                                        <a href="{{ Route('topicPost',['slug'=>$item->slug]) }}" style="margin: 0 20px">
                                            {{ $item->name }}
                                        </a>
                                    </div>
                                    @endforeach


                            </div>
                        </div>
                        @if (count($postnew)>0)
                            <div class="row box-new-topic my-5">

                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <h3 class="title-topic">Bài viết mới</h3>


                                </div>
                                @foreach ($postnew as $item)
                                    <div class="row my-3">
                                        <div class="col-md-3">
                                         <a href="{{ Route('postdetail',['slug'=>$item->slug]) }}">
                                            <img class="layzy" src="{{ $item->image }}" alt="{{ $item->slug }}" width="100%">
                                        </a>
                                        </div>
                                        <div class="col-md-9">
                                            <a class="title-topic-new" href="{{ Route('postdetail',['slug'=>$item->slug]) }}">    {!! \Illuminate\Support\Str::limit(strip_tags($item->title), $limit = 50, $end = '...') !!}</a>
                                            <span style="display: block;margin-top:3px;">
                                                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
    </div>

@endsection
@section('script')
<script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        }
    }
    </script>
@endsection
