@extends('user.layoutsite')
@section('title')
Tìm Kiếm
@endsection
@section('main')

    <div id="pagination_show">

            @includeIf('user.layout.search.searchPaginate')
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
    </script>
@endsection
