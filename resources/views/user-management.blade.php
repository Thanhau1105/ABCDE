<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lí Người Dùng</title>
    <link rel="icon" type="image/x-icon" href="/image/android-chrome-512x512.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/contact.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/management.css">
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
                            <span>{{ $user->full_name}}</span>
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
                            <li><a href="{{route('admin.home')}}" class="active-menu"><i class="fa-solid fa-house"></i>Trang Chủ</a></li>
                            <li><a href="{{route('user.management')}}"><i class="fa-solid fa-house"></i>Quản Lí Người Dùng</a></li>
                            <li><a href="{{route('post.management')}}"><i class="fa-solid fa-house"></i>Quản Lí Bài Đăng</a></li>
                            <li><a href="{{route('comment.management')}}"><i class="fa-solid fa-house"></i>Quản Lí Bình Luận</a></li>
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
<div class="style-body" style="overflow-x: auto;">
    <h1>Danh sách người dùng</h1>
    <table border="1">
        <thead>
        <tr>
            <th>Email</th>
            <th>Họ Và Tên</th>
            <th>Số Điện Thoại</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Cập Nhật</th>
            <th>Bài Đăng</th>
            <th>Bình Luận</th>
            <th>Hành Động</th>
        </tr>
        </thead>
        <tbody>
        @if ($users->isNotEmpty())
            @foreach ($users as $user)
                <tr>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                    <td>{{ $user->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <ul>
                            @foreach ($user->posts as $post)
                                <li>{{ $post->title }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($user->comments as $comment)
                                <li>{{ $comment->content }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center">Không có người dùng nào!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
