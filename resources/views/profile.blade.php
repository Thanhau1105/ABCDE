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
                            <span>{{$user->full_name}}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="{{route ('user.profile')}}">Quản Lí Cá Nhân</a></li>
                            <li><a href="{{route ('logout')}}">Đăng Xuất</a></li>
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
        <form action="{{ route('user.updateProfile') }}" method="POST">
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

    <div class="post-container">
        <label>Danh Sách Bài Đăng Của Bạn</label>
        <div class="row">
            @if ($posts && $posts->isNotEmpty())
                @foreach ($posts as $post)
                    @if ($post != null)
                        <div class="col-md-6 col-12">
                            <div class="inner-box">
                                @if ($post->listImages && $post->listImages->isNotEmpty())
                                    <div class="inner-img">
                                        <img src="{{ asset('storage/' . $post->listImages[0]->url) }}" alt="Post Image" class="image" />
                                    </div>
                                @endif
                                <div class="inner-content">
                                    <h3 class="title">{{ $post->title }}</h3>
                                    <form action="{{ route('user.deletePost', ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa bài đăng này không?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @if ($post->location && $post->location->link)
                                        <a href="{{ $post->location->link }}" target="_blank" class="btn inner-location">
                                            <i class="fa-solid fa-map-location"></i>
                                            <p class="line-clamp" style="--line-clamp:1;">{{ $post->location->address }}</p>
                                        </a>
                                    @endif
                                    <div class="inner-bot">
                                        <p class="inner-price"><span>{{ number_format($post->price, 0, ',', '.') }}</span> VND</p>
                                        <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn">Xem Bài Đăng</a>
                                    </div>
                                    <div>
                                        <p class="post-status">{{ $post->approved ? 'Đã được duyệt' : 'Chưa được duyệt' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="no-posts-message">Bạn chưa có bài đăng nào.</p>
            @endif
        </div>
    </div>
    <div class="comment">
        <label>Danh Sách Bình Luận Của Bạn</label>
        <ul class="comments-list">
            @if ($comments->isEmpty())
                <p class="no-comments-message">Bạn chưa có bình luận nào.</p>
            @else
                @foreach($comments as $comment)
                    <li class="comment-item">
                        <div class="comment-rating">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="{{ $i < $comment->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                            @endfor
                        </div>
                        <div class="comment-content">
                            <p>{{ $comment->content }}</p>
                            <a href="{{ route('post.detail', ['id' => $comment->post_id]) }}" class="btn">Xem Bình Luận</a>
                            <span class="comment-status">
                            {{ $comment->approved ? 'Đã Được Duyệt' : 'Chưa Được Duyệt' }}
                        </span>
                            <form action="{{ route('user.deleteComment', ['id' => $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa comment này không?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
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
