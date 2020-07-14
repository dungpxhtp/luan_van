@extends('user.layoutsite')
@section('title')
  Tổng Hợp Tin Tức Shop
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
                                    <h3>Danh Mục Tham Khảo</h3>
                            </div>
                            <div class="col-md-12">
                                @foreach ($topic as $item)
                                <i class="fas fa-chevron-right"></i>
                                <a href="" style="margin: 0 20px">
                                    {{ $item->name }}
                                </a>
                                @endforeach

                            </div>
                        </div>
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
