<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Bài</title>
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
    <link rel="stylesheet" href="/css/create-post.css">
</head>
<body>
<div class="header-1">
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="inner-head">
                        <div class="inner-logo">
                            <a href="{{route ('user.home')}}" >
                                <img src="/image/logo.png" alt="logo">
                            </a>
                        </div>
                        <div class="inner-menu">
                            <ul class="menu">
                                <li><a href="{{route ('user.home')}}" class="active-menu">Trang Chủ</a></li>
                                <li><a href="{{route ('introduce')}}" class="active-menu">Giới Thiệu</a></li>
                                <li><a href="{{route('post')}}" class="active-menu">Bài Đăng</a></li>
                                <li><a href="{{route ('contact')}}" class="active-menu">Liên Hệ</a></li>
                            </ul>
                        </div>
                        <div class="user-dropdown">
                            <div class="dropdown-toggle">
                                <i class="fa-solid fa-user"></i>
                                <span>{{ $user->full_name }}</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="{{route ('user.profile')}}">Quản Lí Cá Nhân</a></li>
                                <li><a href="{{route('logout')}}">Đăng Xuất</a></li>
                            </ul>
                        </div>
                        <div class="inner-menu-mb">
                            <div class="menu-mb-icon"><i class="fa-solid fa-bars"></i></div>
                            <ul class="menu-mb">
                                <li><a href="{{route ('user.home')}}" class="active-menu"><i class="fa-solid fa-house"></i>Trang Chủ</a></li>
                                <li><a href="{{route ('introduce')}}"><i class="fa-solid fa-house"></i>Giới Thiệu</a></li>
                                <li><a href="{{route('post')}}"><i class="fa-solid fa-house"></i>Bài Đăng</a></li>
                                <li><a href="{{route ('contact')}}"><i class="fa-solid fa-house"></i>Liên Hệ</a></li>
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
</div>

<div class="container mt-5">
    <div class="post">
        <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="image-1 mb-3">
                        <div class="img-wrap" id="imgWrap">
                        </div>
                        <div class="image-upload">
                            <label class="label-1" for="images">
                                <i class="fa-solid fa-file-arrow-up"></i> Tải lên hình ảnh
                            </label>
                            <input type="file" name="images[]" id="images" hidden multiple>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="post-content mb-3">
                        <label class="label-1" for="title">Nội dung đăng bài:</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề"
                               required>
                    </div>

                    <div class="price mb-3">
                        <label class="label-1" for="price">Giá:</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="Giá" required>
                    </div>

                    <div class="description mb-3">
                        <label class="label-1" for="description">Miêu tả:</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Miêu tả"
                                  rows="3" required></textarea>
                    </div>
                    <div class="address mb-3">
                        <label class="label-1" for="streetAddress">Số nhà & Tên đường:</label>
                        <input type="text" id="streetAddress" name="streetAddress" class="form-control" placeholder="Số nhà & Tên đường" required>
                    </div>
                    <div class="address mb-3">
                        <label class="label-1" for="ward">Xã/Phường:</label>
                        <input type="text" id="ward" name="ward" class="form-control" placeholder="Xã/Phường" required>
                    </div>
                    <div class="address mb-3">
                        <label class="label-1" for="district">Huyện/Quận:</label>
                        <input type="text" id="district" name="district" class="form-control" placeholder="Huyện/Quận" required>
                    </div>
                    <div class="address mb-3">
                        <label class="label-1" for="city">Tỉnh/Thành phố:</label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Tỉnh/Thành phố" required>
                    </div>
                    <div class="amenities mb-3">
                        <label class="label-1">Tiện ích:</label>
                        <ul>
                            @foreach ($amenities as $amenity)
                            <li>
                                <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}">
                                <span>{{ $amenity->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="submit-button">
                        <button type="submit" class="btn btn-primary">Đăng bài</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/js/create-post.js"></script>
</body>
</html>
