<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Đăng Nhập</title>
    <link rel="stylesheet" href="{{ asset('css/bs4/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/formlogin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style/normalize.min.css') }}">
</head>
<body>

    <div class="container-fluid">
        <div class="row">

        </div>
        <div class="row row-login align-items-center">

            <div class="col col-login">

                <form name="myForm" class="form-content fadeIn" onsubmit="return validateForm();" method="POST" action="{{ Route('loginAdmin') }}">
                    @csrf
                    <div class="form-group" style="margin-top:10px;">
                        <label for="exampleInputPassword1"></label>

                      <input type="email" required="required" name="inputEmail"   class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Nhập Vào Tài Khoản">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="password" name="inputPassword" required="required" class="form-control" id="inputPassword" placeholder="Nhập Vào Mật Khẩu">
                    </div>

                    <button type="submit" class="btn btn-success btn-login">Đăng Nhập</button>

                  </form>

            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var x = document.forms["myForm"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("Not a valid e-mail address");
                return false;
            }
        }
        </script>

    <script src="{{ asset('js/bs4/bootstrap.min.js') }}">
    </script>
</body>

</html>
