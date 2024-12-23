<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="icon" type="image/x-icon" href="/image/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/register.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="register">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-6 col-12">
                <div class="inner-form">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" class="form">
                        @csrf
                        <label for="fullName">Họ Và Tên</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" required>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required >

                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required >

                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control" required>

                        <label for="password_confirmation">Nhập Lại Mật Khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>

                        <button type="submit" class="btn-register">Đăng Ký</button>
                        <div class="inner-line"></div>
                        <div class="login">
                            <span>Bạn đã có tài khoản ?</span>
                            <a href="{{route('login')}}" class="">Đăng nhập ở đây</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-6">
                <div class="inner-img">
                    <img src="/image/login.jpg" alt="" class="image">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
