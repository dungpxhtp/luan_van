@extends('admin.layoutsite')
@section('title')
    Quản Lý Tài khoản
@endsection
@section('main')
{{ Breadcrumbs::render('account','Thông Tin Tài Khoản') }}
<div class="clearfix my-2">
    @includeIf('admin.products.modules.message')

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <span class="account-header">Thông Tin Cá Nhân</span>

                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12 my-2">

                            <form action="{{ Route('admin.update_information',['id_admin'=>Auth::guard('admin')->user()->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                  <div class="col-sm-10">
                                    {{ Auth::guard('admin')->user()->email }}
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Họ Tên</label>

                                    <div class="col-sm-10">
                                      <input type="text" name="name" required class="form-control" value="{{ Auth::guard('admin')->user()->fullname }}" >
                                      @if ($errors->has('name'))
                                      <span class="text-danger">{{ $errors->first('name') }}</span>
                                      @endif
                                      </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPassword"  class="col-sm-2 col-form-label">Số Điện Thoại</label>

                                  <div class="col-sm-10">
                                    <input name="phone" pattern="(03|07|08|09|01[2|6|8|9])+([0-9]{8})\b" required type="text" class="form-control" value="{{ Auth::guard('admin')->user()->phone }}">
                                    </div>
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>



                                    <div class="form-group row box-password " style="display: none">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Mật Khẩu Mới</label>

                                        <div class="col-sm-10">
                                          <input type="hidden" required minlength="10" name="password-new" class="form-control" id="password-input" placeholder="Mật Khẩu Mới" >
                                          <input type="checkbox" onclick="myFunction()">Hiển Thị Mật Khẩu
                                          </div>
                                          @if ($errors->has('inputPassword'))
                                          <span class="text-danger">{{ $errors->first('inputPassword') }}</span>
                                          @endif
                                    </div
                            <div class="form-group row">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Cập nhật
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-12">
                                <button class="change-password">Đổi Mật Khẩu</button>
                              </div>
                            </div>
                           </form>

                </div>
            </div>
        </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#thongbao").modal('show');
    });
</script>
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
      $(document).ready(function(){
            $(document).on('click','.change-password',function(){

                event.preventDefault();
                var x = document.getElementById("password-input");
                x.type= "password";
                $('.box-password ').show();
                $('.change-password').hide();
            });
      });
</script>
@endsection
