<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Hồ Sơ Cá Nhân</title>
    <link rel="icon" type="image/x-icon" href="/image/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200"/>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/contact.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/post.css">
    <link rel="stylesheet" href="/css/postdetail.css">
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="inner-head">
                    <div class="inner-logo">
                        <a href="{{route ('admin.home')}}">
                            <img src="/image/logo.png" alt="logo">
                        </a>
                    </div>
                    <div class="inner-menu">
                        <ul class="menu">
                            <li><a href="{{route('admin.home')}}" class="active-menu">Trang Chủ</a></li>
                            <li><a href="{{route('user.management')}}">Quản Lí Người Dùng</a></li>
                            <li><a href="{{route('post.management')}}">Quản Lí Bài Đăng</a></li>
                            <li><a href="{{route('comment.management')}}">Quản Lí Bình Luận</a></li>
                        </ul>
                    </div>
                    <div class="user-dropdown">
                        <div class="dropdown-toggle">
                            <i class="fa-solid fa-user"></i>
                            <span>{{$user->full_name}}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.profile')}}">Quản Lí Cá Nhân</a></li>
                            <li><a href="{{route ('logout')}}">Đăng Xuất</a></li>
                        </ul>
                    </div>

                    <div class="inner-menu-mb">
                        <div class="menu-mb-icon"><i class="fa-solid fa-bars"></i></div>
                        <ul class="menu-mb">
                            <li><a href="{{route ('admin.home')}}" class="active-menu"><i class="fa-solid fa-house"></i>Trang Chủ</a></li>
                            <li><a href="{{route ('user.management')}}"><i class="fa-solid fa-house"></i>Giới Thiệu</a></li>
                            <li><a href="{{route('post.management')}}"><i class="fa-solid fa-house"></i>Bài Đăng</a></li>
                            <li><a href="{{route ('comment.management')}}"><i class="fa-solid fa-house"></i>Liên Hệ</a></li>
                            <li class="item-action">
                                <a href="{{route('login')}}">Đăng Nhập</a>
                                <a href="{{route('logout')}}">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
<div class="profile-container">
    <div class="profile-header">
        <i class="fa-solid fa-user-circle" style="font-size: 50px;"></i>
        <h2>Hồ Sơ Cá Nhân</h2>
    </div>
    <div class="profile-info">
        <label for="email">Email:</label>
        <p id="email">{{$user->email}}</p>

        <label for="fullName">Họ Tên:</label>
        <p id="fullName">{{$user->full_name}}</p>

        <label for="phone">Số Điện Thoại:</label>
        <p id="phone" >{{$user->phone}}</p>

        <a href="javascript:void(0);" class="btn-edit-profile" onclick="editProfile()">
            <i class="fa-solid fa-pen"></i>
        </a>
    </div>
    <div id="editForm" style="display: none;">
        <form action="{{ route('admin.updateProfile') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fullNameEdit">Họ Tên:</label>
                <input
                    type="text"
                    id="fullNameEdit"
                    name="full_name"
                    value="{{ old('fullName', $user->full_name) }}"
                    class="form-control"
                    required>
            </div>
            <div class="form-group">
                <label for="phoneEdit">Số Điện Thoại:</label>
                <input
                    type="text"
                    id="phoneEdit"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="form-control"
                    required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Hủy</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    function editProfile() {
        console.log("Chỉnh sửa profile");
        document.querySelector('.profile-info').style.display = 'none';
        document.getElementById('editForm').style.display = 'block';
    }
    function cancelEdit() {
        document.querySelector('.profile-info').style.display = 'block';
        document.getElementById('editForm').style.display = 'none';
    }
</script>
</body>
</html>
