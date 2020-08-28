@extends('user.layoutsite')
@section('title')
   @if (isset($topicPost))
        {{ $topicPost->name }}
   @else
    Tổng Hợp Tin Tức

   @endif
@endsection
@section('head')
    <style>
        .topic-link{
            font-size: 1.4rem;
            color: #111;
            line-height: 2;
            font-weight: 500;
            text-transform: uppercase;

        }
        .title-topic-new{
            text-transform: capitalize;
            font-size: 1.3rem;
            color: #111;
            font-weight: 500;
        }
        .topic-link:hover{
            text-decoration: none;
        }
        .title-topic{
            border-bottom: #900 2px solid;
        }
        .title-post{
            text-transform: capitalize;
            display: block;
            justify-content: center;
            font-size: 2rem;
            line-height: 2;
            color: #111;
            font-weight: 700;
        }
        .title-post:hover{
            text-decoration: none;
        }
        .text-description{
            font-size: 1.3rem;

        }
        .read-more a{
            font-size: 1.4rem;
        }
    </style>
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
                        <span class="span-title">Tin Tức</span>
                    </h3>
                </div>
            </div>
    </div>
    <div class="clearfix my-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        @if (count($post)>0)
                        <div id="pagination_show">
                           @includeIf('user.layout.tinTuc.tintuc_paginaton')
                        </div>
                        @else
                            <p class="text-danger">
                                Chưa Có Bài Viết
                            </p>
                        @endif

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
                                        <a class="topic-link" href="{{ Route('topicPost',['slug'=>$item->slug]) }}" style="margin: 0 20px">
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
                                    <div class="row my-3" style="margin: 0 auto;">
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
    $(document).ready(function(){
        $(document).ajaxStart(function() {
            $("#loading").show();
        });
        $(document).ajaxStop(function() {
            $("#loading").hide();
        });
    });
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<i class="fas fa-spinner"></i>');

        var url = $(this).attr('href');
        console.log(url);
        getArticles(url);

       // window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('#pagination_show').html(data);
            jQuery('html, body').animate({scrollTop: 0}, 500);

        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
});
   $(document).on('change','#input-filter',function(){
       var filter =($('#input-filter').val());
       if(filter !=0)
       {
       var slug=$(this).find('option:selected').attr('data-url');
       $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let url="{{ Route('brands_products.filter',':slug') }}";
        url = url.replace(':slug', slug);

        $.ajax({
                url:url,
                type:'GET',
                data:{
                    filter:filter
                },
                success:function(data)
                {
                    $('#pagination_show').html(data);
                }

        });
       }

   })
    </script>
@endsection
