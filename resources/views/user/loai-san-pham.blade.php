@extends('user.layoutsite')
@section('title')
    {{ $loaisanpham->name }}
@endsection
@section('meta')
    <meta name="description" content="{{ $loaisanpham->metadesc }}" />
    <meta name="keywords" content="{{ $loaisanpham->metakey }}">


@endsection
@section('main')

        <div class="clearfix my-5">

            <div class="container">
                <div class="row">

                    <div class="col-md-12 d-flex justify-content-center">
                        <div id="loading" style="display:none">
                            <img src="https://kiemtiencenter.com/wp-content/uploads/2018/08/loading-2.gif" alt="Loading..."/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center ">
                        <h3 class="title-product text-uppercase">
                            <span class="span-title">{{ $loaisanpham->name }}</span>
                        </h3>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12 text-center">
                        <p> <i>
                            “Người ta vẫn thường nói “thời gian là vĩnh cữu”, mọi thứ trên thế giới này có thể bị lụi tàn hoặc thụt lùi, nhưng thời gian sẽ không bao giờ phai mờ. Chính vì thế, hãy trân trọng thời gian của mình đang có với một chiếc đồng hồ chính hãng (vật dùng để kiểm soát thời gian). Nếu bạn là phái mạnh, thì đồng hồ đeo tay nam chính hãng không chỉ đơn giản dùng để kiểm soát thời gian dành cho bạn mà còn phụ kiện để khẳng định địa vị trong xã hội. Nếu bạn là phái đẹp, thì đồng hồ đeo tay nữ chính hãng sẽ là phụ kiện thời trang sành điệu nhất trong những sự kiện quan trọng dành cho bạn….”
                        </i>
                        </p>
                    </div>
                </div>
                @if (count($products)>0)
                     <div class="row my-3">
                        <div class="col-md-4">
                           <span class="filter-dk"> Điều Kiện Lọc</span>
                            <div class="input-group mb-3">
                                <select class="custom-select" id="input-filter">
                                  <option value="0"  selected>Lọc Sản Phẩm Theo Giá </option>

                                  <option value="1" data-url="{{ $loaisanpham->slug }}">Giá Thấp Đến Cao</option>
                                  <option value="2" data-url="{{ $loaisanpham->slug }}">Giá Từ Cao Xuống Thấp</option>
                                </select>
                              </div>
                        </div>

                    </div>
                    {{-- <div class="row my-3">
                        <div class="col-md-4">
                            <div class="box-filter">
                                <span class="filter-dk"> Độ Chống Nước</span>
                                <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" name="exampleRadios" value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Default radio
                                    </label>
                                  </div>
                                  <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" name="exampleRadios"  value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                      Second default radio
                                    </label>
                                  </div>
                                  <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" name="exampleRadios" value="option1">
                                    <label class="form-check-label" for="exampleRadios1">
                                      Default radio
                                    </label>
                                  </div>
                                  <div class="form-check checkbox">
                                    <input class="form-check-input" type="checkbox" name="exampleRadios"  value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                      Second default radio
                                    </label>
                                  </div>
                            </div>
                        </div>

                    </div> --}}
                    <div id="pagination_show">
                        @includeIf('user.layout.loaiSanPham.loai_pagination')
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger">
                            Không Có Sản Phẩm
                        </p>
                    </div>
                </div>
                @endif


                <div class="row">

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
                url : url,
                success:function(data){
                    $('#pagination_show').html(data);
                }
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
            let url="{{ Route('category.filter',':slug') }}";
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

       });

        </script>
@endsection
