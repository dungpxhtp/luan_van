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
                    <form action="{{ Route('postRegister') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tên Đầy Đủ</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" required  class="form-control " placeholder="Nguyễn Văn A" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text"  class="form-control" required name="email" placeholder="email@example.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <small class="form-text text-muted">Vui lòng nhập đúng email của bạn chúng tôi không chia sẻ email này cho bất kì ai </small>
                          </div>

                        </div>
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-2 col-form-label">Mật Khẩu</label>
                          <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" minlength="11" id="password-input" placeholder="Mật Khẩu" value="{{ old('password') }}">
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
@endsection
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
@endsection
