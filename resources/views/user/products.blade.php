@extends('users')
@section('title', 'Cửa Hàng')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang Chủ</a>
                            <span>Cửa hàng</span>
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
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{route('products')}}" method="GET">
                                <input type="text" name="search" placeholder="Tìm Kiếm..." value="{{$search}}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Danh Mục</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach($categories as $category)
                                                        <li><a href="category/{{$category->id}}">{{$category->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($products as $product)

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <a href="{{route('product-detail', $product->id)}}">
                                        <div class="product__item__pic set-bg" data-setbg="../images/product/{{$product->avatar}}">
                                            @if(!empty($product->promotion_price))
                                                <span class="label">Giảm {{$product->promotion_price}}%</span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="product__item__text">
                                        <h6>{{$product->name}}</h6>
                                        <a href="{{route('product-detail', $product->id)}}" class="add-cart">Xem Chi Tiết</a>
                                        @if(!empty($product->promotion_price))
                                            <h5>{{ number_format($product->original_price - $product->original_price * ($product->promotion_price/100)) }}đ <sup><del>{{number_format($product->original_price)}}đ</del></sup></h5>
                                        @else
                                            <h5>{{number_format($product->original_price)}}đ</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
