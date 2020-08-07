@extends('user.layoutsite')
@section('title')
    Đăng Ký
@endsection
@section('style')
    <style>
        .resgister{
            display: none;
        }
    </style>
@endsection
@section('main')
    {{ Breadcrumbs::render('resgister','Đăng Ký') }}
    <div class="clearfix my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                        <h3> Đăng Ký Tài Khoản</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="dangky">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tên Đầy Đủ</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" required  class="form-control " placeholder="Nguyễn Văn A" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text"  class="form-control email" required name="email" placeholder="email@example.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <small class="form-text text-muted">Vui lòng nhập đúng email của bạn chúng tôi không chia sẻ email này cho bất kì ai </small>
                          </div>

                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Mật Khẩu</label>
                          <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" minlength="11" id="password-input" placeholder="Mật Khẩu" value="{{ old('password') }}" autocomplete="on">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <div>
                                <small class="form-text text-muted">Mật Khẩu Không Dưới 11 Kí Tự </small>
                            </div>
                            <div>
                                <input type="checkbox" onclick="myFunction()">Hiển Thị Mật Khẩu
                            </div>

                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input id="mobile" name="phone" pattern="(03|07|08|09|01[2|6|8|9])+([0-9]{8})\b" required type="tel" class="form-control" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                <small id="emailHelp" class="form-text text-muted">Định Dạng Số Điện Thoại 10 Số Ví Dụ 035xxxxxxx</small>
                                <div>
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-sm btn-success">Đăng Ký</button>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal verification  " tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Xác Thực Email</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="active_xac_thuc">
            <div class="modal-body">
                <input type="number" name="code_active" required class="code_active" style="width: 100%;"/>
                <input type="hidden" name="email_active" class="email_active">

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary ">Xác Thực</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </form>
            </div>
          </div>
        </div>
      </div>
@endsection
{{--  Admin Xác Thực  --}}
@section('script')
    <script>
        function myFunction() {
            var x = document.getElementById("password-input");
            console.log('ok');
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>
    <script>
        $(document).ready(function(){
           $(document).on('submit','#dangky',function(evet){
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url ="{{ Route('postRegister') }}";
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
                        $('.email_active').val($('.email').val());
                        $('.verification').modal('show');
                    }else
                    {

                        $.each(data.danger,function(key,val){
                            alertify.error(val[0]);
                        })


                    }
                }
            });

           });
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

                        }else if(data.danger)
                        {
                            alertify.error(data.danger);
                        }
                    }
                });
           });

        });


    </script>
@endsection
