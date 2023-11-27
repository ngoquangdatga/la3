@extends('users')
@section('title', 'Trang Chủ')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            @foreach($banners as $banner)
                <div class="hero__items set-bg" data-setbg="../images/banner/{{$banner->images}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Danh Mục</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($category as $cate)
                    <div class="col-lg-4 mt-2">
                        <div class="banner__item">
                            <div class="banner__item__pic">
                                <img src="../images/category/{{$cate->images}}" alt="">
                            </div>
                            <div class="banner__item__text">
                                <h2>{{$cate->name}}</h2>
                                <a href="category/{{$cate->id}}">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản Phẩm</h2>
                    </div>
                </div>
            </div>
            <div class="row product__filter">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <a href="{{route('product-detail', $product->id)}}">
                            <div class="product__item__pic set-bg" data-setbg="../images/product/{{$product->avatar}}">
                                @if(!empty($product->promotion_price))
                                    <span class="label">Giảm{{$product->promotion_price}}%</span>
                                @endif
                            </div>
                        </a>
                        <div class="product__item__text">
                            <h6>{{$product->name}}</h6>
                            <a href="{{route('product-detail', $product->id)}}" class="add-cart">Xem Chi Tiết</a>
                            @if(!empty($product->promotion_price))
                                <h5>{{number_format($product->original_price - $product->original_price * ($product->promotion_price/100)) }}đ <sup><del>{{number_format($product->original_price)}}đ</del></sup></h5>
                            @else
                                <h5>{{number_format($product->original_price)}}đ</h5>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">
                    <a href="{{route('products')}}" class="btn btn-primary ">Xem thêm</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Bài Viết Mới Nhất</span>
                        <h2>Xu Hướng Thời Trang Mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="../images/blog/{{$blog->images}}"></div>
                            <div class="blog__item__text">
                                <span><img src="../user/img/icon/calendar.png" alt=""> {{date('d F Y', strtotime($blog->created_at))}} </span>
                                <h5>{{$blog->title}}</h5>
                                <a href="{{route('blog-details', $blog->id)}}">Đọc Tiếp</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-sm-12">
                    <div class="d-flex justify-content-center">
                        <a href="{{route('blogs')}}" class="btn btn-primary ">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection
