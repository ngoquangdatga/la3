@extends('users')
@section('title', 'Bài Viết')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="../user/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Bài Viết</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach($blogs as $blog)
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
            <div class="row">
                <div class="col-sm-12">
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
