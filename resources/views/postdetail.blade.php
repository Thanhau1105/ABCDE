<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$post->title}}</title>
  <link rel="icon" type="image/x-icon" href="/image/android-chrome-512x512.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,200"/>
  <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/postdetail.css">
  <link rel="stylesheet" href="/css/style.css">
  <style>
    img {
      max-width: 100%;
    }
  </style>
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
              <li><a href="{{route ('introduce')}}">Giới Thiệu</a></li>
              <li><a href="{{route('post')}}">Bài Đăng</a></li>
              <li><a href="{{route ('contact')}}">Liên Hệ</a></li>
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
              <li><form action="/logout" method="post">
                <button type="submit">Đăng Xuất</button>
              </form></li>
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

<div class="pt">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-xs-3 col-12 inner-left">
        <div class="inner-slide">
          <div class="btn-left"><i class="fa-solid fa-arrow-up"></i></div>
            @foreach($post->listImages as $image)
            <div class="slide">
                <img src="{{ asset('storage/' . $image->url) }}" alt="Post Image" class="image"/>
            </div>
            @endforeach
            <div class="btn-right"><i class="fa-solid fa-arrow-down"></i></div>
        </div>
      </div>
      <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9 col-xs-9 col-12">
        <div class="inner-center">
          <div class="inner-head">
            <figure>
                @if($post->listImages && count($post->listImages) > 0)
                <img src="{{ asset('storage/' . $post->listImages[0]->url) }}" alt="Post Image" class="image"/>                @endif
                <figcaption>
                <h1 class="inner-title">{{$post->title}}</h1>
                <span> {{ number_format($post->price, 0, ',', '.') }}</span> VND<br>
                <div class="inner-location">
                    <a href="{{ $post->location->link }}" target="_blank">
                    <i class="fa-solid fa-map-location"></i>
                        <p class="line-clamp" style="--line-clamp:1;">{{ $post->location->address }}</p>
                  </a>
                </div>
              </figcaption>
            </figure>
          </div>
          <div class="inner-content">
            <div class="inner-overview">
              <h2 class="inner-title">Tổng quan</h2>
              <p class="inner-para">{{$post->description}}</p>
            </div>
            <div class="inner-utilities">
              <h2 class="inner-title">Tiện ích</h2>
                @foreach ($amenities as $amenity)
              <div class="utilities">
                <div class="col-4">
                  <div class="inner-box">
                    <ul>
                      <li>{{ $amenity->name }}</li>
                    </ul>
                  </div>
                </div>
              </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3">
        <div class="inner-right">
            @foreach ($posts as $post)
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6">
              <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="inner-other">
                  @if ($post->listImages && $post->listImages->isNotEmpty())
                <div class="inner-img">
                    <img src="{{ asset('storage/' . $post->listImages[0]->url) }}" alt="Post Image" class="image"/>
                </div>
                  @endif
                <h5>{{$post->title}}</h5>
                <p><span>{{ number_format($post->price, 0, ',', '.') }}</span> VND</p>
                <div class="location">
                  <i class="fa-solid fa-map-location"></i>
                    <p class="line-clamp" style="--line-clamp:1;">{{ $post->location->address }}</p>
                </div>
              </a>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <h2>Bình luận</h2>
    <form action="{{ route('comment.store') }}" method="POST" class="comment-form">
        @csrf
        <div class="form-group">
            <label>Đánh giá:</label>
            <div class="rating">
                <input type="radio" name="rating" value="5" id="star1" required>
                <label for="star1" class="fa fa-star"></label>
                <input type="radio" name="rating" value="4" id="star2">
                <label for="star2" class="fa fa-star"></label>
                <input type="radio" name="rating" value="3" id="star3">
                <label for="star3" class="fa fa-star"></label>
                <input type="radio" name="rating" value="2" id="star4">
                <label for="star4" class="fa fa-star"></label>
                <input type="radio" name="rating" value="1" id="star5">
                <label for="star5" class="fa fa-star"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="content">Nội dung bình luận:</label>
            <textarea id="content" name="content" rows="4" required placeholder="Nhập bình luận của bạn ở đây..."></textarea>
        </div>
        <input type="hidden" name="postId" value="{{ $post->id }}"/>
        <button type="submit" class="submit-comment">Gửi Bình Luận</button>
    </form>

    <div class="comments-section">
        <ul class="comments-list">
            @foreach ($comments as $comment)
            <li class="comment-item">
                <div class="comment-rating">
                    @for ($i = 0; $i < 5; $i++)
                    <i class="{{ $i < $comment->rating ? 'fas fa-star' : 'far fa-star' }}"></i>
                    @endfor
                </div>
                <div class="comment-content">
                    <p>{{ $comment->content }}</p>
                    <p class="comment-author">- {{ $comment->user->email }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<script src="/js/header.js"></script>
<script src="/js/show-room"></script>
</body>
</html>
