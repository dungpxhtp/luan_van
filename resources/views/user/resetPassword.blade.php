@extends('user.layoutsite')
@section('title')
    Quên Mật Khẩu
@endsection
@section('style')
        <style>
            .account{
                display: none;
            }
        </style>
@endsection
@section('main')
{{ Breadcrumbs::render('resetPassword','Quên Mật Khẩu') }}
    <div class="clearfix my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                        <h3>Đổi Mật Khẩu</h3>
                </div>
                <div class="col-md-8">
                        <form action="{{ Route('postResetPassword') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Nhập Vào Email Bạn Đã Đăng Ký </label>
                                  <input type="email" required name="email" class="form-control" placeholder="Địa Chỉ Email">
                                </div>

                                <button type="submit" class="btn btn-primary">Gửi Mail</button>

                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
