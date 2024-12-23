<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Bài Đăng</title>
    <link rel="icon" type="image/x-icon" href="/image/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200"/>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/post.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/contact.css">
</head>
<body>
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="inner-head">
                    <div class="inner-logo">
                        <a href="{{ Auth::check() ? (Auth::user()->role_id == 1 ? route('user.home') : (Auth::user()->role_id == 2 ? route('admin-home') : route('home'))) : route('home') }}">
                            <img src="/image/logo.png" alt="logo">
                        </a>
                    </div>
                    <div class="inner-menu">
                        <ul class="menu">
                            <li><a href="{{route ('user.home')}}" class="active-menu">Trang Chủ</a></li>
                            <li><a href="{{route ('introduce')}}">Giới Thiệu</a></li>
                            <li><a href="{{route('post')}}">Bài Đăng</a></li>
                            <li><a href="{{route ('contact')}}">Liên Hệ</a></li>
                        </ul>
                    </div>
                    @if(Auth::check() && Auth::user()->role_id)
                        <div class="user-dropdown">
                            <div class="dropdown-toggle">
                                <i class="fa-solid fa-user"></i>
                                <span>{{ Auth::user()->full_name ?? '' }}</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ Auth::user()->role_id == 1 ? route('user.profile') : (Auth::user()->role_id == 2 ? route('admin.profile') : '#') }}">
                                        Quản Lí Cá Nhân
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}">Đăng Xuất</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="inner-menu-mb">
                        <div class="menu-mb-icon"><i class="fa-solid fa-bars"></i></div>
                        <ul class="menu-mb">
                            <li><a href="{{ Auth::check() ? (Auth::user()->role_id == 1 ? route('user.home') : (Auth::user()->role_id == 2 ? route('admin-home') : route('home'))) : route('home') }}"><i class="fa-solid fa-house"></i>Trang Chủ</a></li>
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
<div class="container">
    <div class="post-container">
        @if (Auth::check() && Auth::user()->role_id != null)
            <a href="{{ route('post.create') }}" class="btn btn-primary" name="create">Đăng Bài</a>
        @endif
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-6 col-12">
                <div class="inner-box">
                    @if ($post->listImages && $post->listImages->isNotEmpty())
                    <div class="inner-img">
                        <img src="{{ asset('storage/' . $post->listImages[0]->url) }}" alt="Post Image" class="image"/>
                    </div>
                    @endif
                    <div class="inner-content">
                        <h3 class="title">{{ $post->title}}</h3>
                        @if ($post->location && $post->location->link)
                            <a href="{{ $post->location->link }}" target="_blank" class="btn inner-location">
                            <i class="fa-solid fa-map-location"></i>
                                <p class="line-clamp" style="--line-clamp:1;">{{ $post->location->address }}</p>
                            </a>
                        @endif
                        <div class="inner-bot">
                            <p>
                                <span>{{ number_format($post->price, 0, ',', '.') }}</span> VND
                            </p>
                            <a href="{{ Auth::check() && Auth::user()->role_id ? route('post.detail', ['id' => $post->id]) : route('login') }}"
                                class="btn">
                                Xem Bài Đăng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script src="/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
