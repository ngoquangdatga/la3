@extends('users')
@section('title', 'Chi Tiết Bài Viết')
@section('content')
    <style>
        .single_post {
            -webkit-transition: all .4s ease;
            transition: all .4s ease
        }

        .single_post .body {
            padding: 30px
        }

        .single_post .img-post {
            position: relative;
            overflow: hidden;
            max-height: 500px;
            margin-bottom: 30px
        }

        .single_post .img-post>img {
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
            opacity: 1;
            -webkit-transition: -webkit-transform .4s ease, opacity .4s ease;
            transition: transform .4s ease, opacity .4s ease;
            max-width: 100%;
            filter: none;
            -webkit-transform: scale(1.01)
        }

        .single_post .img-post:hover img {
            -webkit-transform: scale(1.02);
            -ms-transform: scale(1.02);
            transform: scale(1.02);
            opacity: .7;
            -webkit-transition: all .8s ease-in-out
        }

        .single_post .img-post:hover .social_share {
            display: block
        }

        .single_post p {
            font-size: 16px;
            line-height: 26px;
            font-weight: 300;
            margin: 0
        }

        .single_post .blockquote p {
            margin-top: 0 !important
        }

        .single_post .meta {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .single_post .meta li {
            display: inline-block;
            margin-right: 15px
        }

        .single_post .meta li a {
            font-style: italic;
            color: #959595;
            text-decoration: none;
            font-size: 12px
        }

        .single_post .meta li a i {
            margin-right: 6px;
            font-size: 12px
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang Chủ</a>
                            <a href="{{route('blogs')}}">Bài Viết</a>
                            <span>{{$blogs->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card single_post">
                            <div class="body">
                                <h3>{{$blogs->title}}</h3>
                                <span>
									<span class="cl4">Bởi</span> Admin
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

                                <span>
									{{$blogs->created_at}}
									<span class="cl12 m-l-4 m-r-6"></span>
								</span>
                                <br>
                                <br>
                                <p>{!! $blogs->content !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-sm-4 ">
                    <h3>Bài Viết Liên Quan</h3>
                </div>
            </div>
            <br>
            <div class="row">
                @foreach($blogs_cate as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="../images/blog/{{$blog->images}}">
                            </div>
                            <div class="blog__item__text">
                                <span><img src="../user/img/icon/calendar.png" alt="">{{date('d F Y', strtotime($blog->created_at))}}</span>
                                <h5>{{$blog->title}}</h5>
                                <a href="{{route('blog-details', $blog->id)}}">Đọc Tiếp</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
