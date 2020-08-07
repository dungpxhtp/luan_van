@extends('user.layoutsite')
@section('title')
    Xác Thực Gmail
@endsection
@section('main')
    {{ Breadcrumbs::render('account','Active Tài Khoản Đăng Nhập') }}
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <h3 class="title-product text-uppercase">
                    <span class="span-title">Xác Thực Tài Khoản</span>
                </h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center my-3">

            <div class="col-md-8 ">

                <form id="active_xac_thuc">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email_active" class="email_active form-control" placeholder="Nhập vào email đăng ký">

                        </div>
                      </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Mã Code</label>
                        <div class="col-sm-10">
                            <input type="number" name="code_active" required class="code_active form-control" style="width: 100%; height: 100px;" placeholder="Nhập Mã Code Xác Thực"/>

                        </div>
                      </div>


                <div class="form-group row">
                    <a href="">Gửi Lại Mã Xác Thực</a>
                    <button type="submit" class="btn btn-primary ">Xác Thực</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('submit','#active_xac_thuc',function(event){
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url ="{{ Route('active_email') }}";
                $.ajax({
                    url:url,
                    dataType:'json',
                    data:$(this).serialize(),
                    type:'POST',
                    success:function(data)
                    {
                        if(data.success)
                        {
                            alertify.success(data.success);
                            setTimeout(function()
                            {   var home="{{ Route('home') }}";
                                location.replace(home);

                            }, 2000

                            );

                        }
                    }
                });
           });
        });
    </script>
@endsection
