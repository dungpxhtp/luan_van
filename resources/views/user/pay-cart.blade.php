@extends('user.layoutsite')
@section('title')
    Thanh Toán
@endsection
@section('style')
    <style>
        .cart-detail{
            display: none;
        }
        .btn-checkout
        {
            display: none;
        }
        .form-group{
            margin: 10px 0;
        }
        .cart-payment{
            display: block;
        }
    </style>
@endsection
@section('main')

{{ Breadcrumbs::render('cart','Thanh Toán') }}
    <div class="clearfix" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="title-product text-uppercase">
                            <span class="span-title">  Thanh Toán</span>
                          </h3>
                    </div>
            </div>
        </div>
    </div>

    <div class="clearfix my-3">
        <div class="container">
            <div class="row">
                    <div class="box-cart"></div>
            </div>
        </div>
    </div>
@if ($cart->total_quanlity>0)
    <div class="clearfix cart-payment">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                     <div class="form-payment">
                         <form class="form-order-payment">
                             <div class="form-group">
                             <input type="text" class="form-control" name="name" placeholder="Nhập Tên Của Bạn *">
                             </div>
                             <div class="form-group">
                                 <input name="phone" pattern="(03|07|08|09|01[2|6|8|9])+([0-9]{8})\b" required type="tel" class="form-control" placeholder="Số điện thoại">
                                 <small id="emailHelp" class="form-text text-muted">Định Dạng Số Điện Thoại 10 Số Ví Dụ 035xxxxxxx</small>

                             </div>
                             <div class="form-group">
                                 <input type="text" name="address" class="form-control"  required placeholder="Địa Chỉ *">

                             </div>

                             <div class="form-group">
                                 <small>THÔNG TIN THÊM
                                     Ghi chú đơn hàng (tuỳ chọn)</small>
                             <textarea class="form-control" name="notes" required rows="3" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng
                             chi tiết hơn."></textarea>
                             </div>
                             <small>Lưu Ý Đơn Hàng Được Gửi Qua Mail Ban Đầu Bạn Đã Đăng Ký</small>

                     </div>
                </div>
                <div class="col-md-6">
                         <div class="form-check">
                             <label class="form-check-label" for="radio1">
                             <input type="radio" name="option" class="form-check-input" value="1" checked>Trả Tiền Mặt Khi Nhận Hàng
                             </label>
                         </div>
                         <div class="form-check">
                             <label class="form-check-label" for="radio2">
                             <input type="radio" name="option" class="form-check-input"  value="2">Chuyển Khoản Ngân Hàng
                             </label>
                         </div>
                         <div class="form-check">
                             <label class="form-check-label" for="radio2">
                             <input type="radio" name="option" class="form-check-input" value="3">Thanh Toán Online
                             </label>
                         </div>


                             <button type="submit" name="option" class="btn btn-sm btn-success my-3" style="width: 100%;">Đặt Hàng</button>




                 </form>
                   </div>
                </div>
         </div>
        </div>
    </div>
@endif
@endsection
@section('script')
        <script>
            $(document).ready(function(){
                function getCart(){
                    $.ajax({
                        url:'{{ Route('gio-hang') }}',
                        type:'GET',

                    }).done(function(data){

                        $('.box-cart').html(data);
                    });
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(document).on('submit','.form-order-payment',function(event){
                    event.preventDefault();
                    var url = "{{ Route('postPayCart') }}";
                    $.ajax({
                            url:url,
                            type:'POST',
                            data:$(this).serialize(),
                            success:function(data)
                            {
                                $(".form-order-payment")[0].reset();
                                $('.cart-payment').hide();
                                alertify.success(data.success);
                            }
                    }).done(function(){
                        getCart();
                    });
                });
            });
        </script>
@endsection

