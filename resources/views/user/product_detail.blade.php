@extends('users')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <link rel="stylesheet" href="../user/css/nice-select.css" type="text/css">

    <style>

        input[type=radio] {
            display: none;
        }

        input[type=radio]:checked + label span {
            transform: scale(1.25);
        }

        input[type=radio]:checked + label .red {
            border: 2px solid #711313;
        }

        input[type=radio]:checked + label .orange {
            border: 2px solid #873a08;
        }

        input[type=radio]:checked + label .yellow {
            border: 2px solid #816102;
        }

        input[type=radio]:checked + label .olive {
            border: 2px solid #505a0b;
        }

        input[type=radio]:checked + label .green {
            border: 2px solid #0e4e1d;
        }

        input[type=radio]:checked + label .teal {
            border: 2px solid #003633;
        }

        input[type=radio]:checked + label .blue {
            border: 2px solid #103f62;
        }

        input[type=radio]:checked + label .violet {
            border: 2px solid #321a64;
        }

        input[type=radio]:checked + label .purple {
            border: 2px solid #501962;
        }

        input[type=radio]:checked + label .pink {
            border: 2px solid #851554;
        }

        label:hover span {
            transform: scale(1.25);
        }

        label span {
            width: 100%;
            height: 100%;
        }

        label span.red {
            background: #db2828;
        }

        label span.orange {
            background: #f2711c;
        }

        label span.yellow {
            background: #fbbd08;
        }

        label span.olive {
            background: #b5cc18;
        }

        label span.green {
            background: #21ba45;
        }

        label span.teal {
            background: #00b5ad;
        }

        label span.blue {
            background: #2185d0;
        }

        label span.violet {
            background: #6435c9;
        }

        label span.purple {
            background: #a333c8;
        }

        label span.pink {
            background: #e03997;
        }

        .be-comment-block {
            border: 1px solid #edeff2;
            border-radius: 2px;
            padding: inherit;
            border: 1px solid #ffffff;
        }

        .comments-title {
            font-size: 16px;
            color: #262626;
            margin-bottom: 15px;
        }

        .be-img-comment {
            width: 60px;
            height: 60px;
            float: left;
            margin-bottom: 15px;
        }

        .be-ava-comment {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .be-comment-content {
            margin-left: 80px;
        }

        .be-comment-content span {
            display: inline-block;
            width: 47%;
            margin-bottom: 15px;
        }

        .be-comment-name {
            font-size: 13px;
        }

        .be-comment-content a {
            color: #383b43;
        }

        .be-comment-content span {
            display: inline-block;
            width: 47%;
            margin-bottom: 15px;
        }

        .be-comment-time {
            text-align: right;
        }

        .be-comment-time {
            font-size: 11px;
            color: #b4b7c1;
        }

        .be-comment-text {
            font-size: 13px;
            line-height: 18px;
            color: #7a8192;
            display: block;
            background: #f6f6f7;
            border: 1px solid #edeff2;
            padding: 15px 20px 20px 20px;
        }

        .form-group.fl_icon .icon {
            position: absolute;
            top: 1px;
            left: 16px;
            width: 48px;
            height: 48px;
            background: #f6f6f7;
            color: #b5b8c2;
            text-align: center;
            line-height: 50px;
            -webkit-border-top-left-radius: 2px;
            -webkit-border-bottom-left-radius: 2px;
            -moz-border-radius-topleft: 2px;
            -moz-border-radius-bottomleft: 2px;
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
        }

        .form-group .form-input {
            font-size: 13px;
            line-height: 50px;
            font-weight: 400;
            color: #b4b7c1;
            width: 100%;
            height: 50px;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid #edeff2;
            border-radius: 3px;
        }

        .form-group.fl_icon .form-input {
            padding-left: 70px;
        }

        .form-group textarea.form-input {
            height: 150px;
        }

        h1 {
            font-size: 1.5em;
            margin: 10px;
        }

        #rating {
            border: none;
            float: left;
        }

        #rating > input {
            display: none;
        }

        #rating > label:before {
            margin: 5px;
            font-size: 2.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        #rating > .half:before {
            content: "\f089";
            position: absolute;
        }

        #rating > label {
            color: #ddd;
            float: right;
        }

        #rating > input:checked ~ label,
        #rating:not(:checked) > label:hover,
        #rating:not(:checked) > label:hover ~ label {
            color: #FFD700;
        }

        #rating > input:checked + label:hover,
        #rating > input:checked ~ label:hover,
        #rating > label:hover ~ input:checked ~ label,
        #rating > input:checked ~ label:hover ~ label {
            color: #FFED85;
        }

    </style>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="/">Trang Chủ</a>
                            <a href="{{route('products')}}">Cửa Hàng</a>
                            <span>{{$products->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                         data-setbg="../images/product/{{$products->avatar}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                         data-setbg="../images/product/{{$products->img1}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                         data-setbg="../images/product/{{$products->img2}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg"
                                         data-setbg="../images/product/{{$products->img3}}">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="../images/product/{{$products->avatar}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="../images/product/{{$products->img1}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="../images/product/{{$products->img2}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="../images/product/{{$products->img3}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$products->name}}</h4>
                            <div class="rating">
                                <span>{{$count_review}} Đánh giá</span>
                            </div>
                            @if(!empty($products->promotion_price))
                                <h3>{{number_format($products->original_price - $products->original_price * ($products->promotion_price/100)) }}đ <sup>
                                        <del>{{number_format($products->original_price)}}đ</del>
                                    </sup></h3>
                            @else
                                <h3>{{number_format($products->original_price)}}đ</h3>
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="print-error-msg" style="display:none">
                                    </div>
                                </div>
                            </div>
                            <form action="" id="add_to_cart" method="POST">
                                @csrf
                                <div class="product__details__option">
                                    <input type="hidden" name="name" value="{{$products->name}}">
                                    <div class="product__details__option__size">
                                        <span>Kích thước:</span>
                                        <label for="xxl">xxl
                                            <input type="radio" name="size" id="xxl" value="XXL">
                                        </label>
                                        <label for="xl">xl
                                            <input type="radio" name="size" id="xl" value="XL">
                                        </label>
                                        <label for="l">l
                                            <input type="radio" name="size" id="l" value="L">
                                        </label>
                                        <label for="m">m
                                            <input type="radio" name="size" id="m" value="M">
                                        </label>
                                        <label for="sm">s
                                            <input type="radio" name="size" id="s" value="S">
                                        </label>
                                    </div>
                                    <div class="product__details__option__color">
                                        <span>Màu:</span>

                                        <input type="radio" name="color" id="red" value="Màu Đỏ"/>
                                        <label for="red"><span class="red"></span></label>

                                        <input type="radio" name="color" id="green" value="Màu Xanh"/>
                                        <label for="green"><span class="green"></span></label>

                                        <input type="radio" name="color" id="yellow" value="Màu vàng"/>
                                        <label for="yellow"><span class="yellow"></span></label>

                                    </div>
                                </div>
                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$products->id}}">
                                    </div>
                                    <button type="button" id="btn-add-to-cart" class="primary-btn">Thêm vào giỏ</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs5" role="tab">Mô Tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Mô Tả Thêm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Đánh giá
                                        ({{$count_review}})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs5" role="tabpanel">
                                    <div class="product__details__tab__content" style="text-align: center;">
                                        {!! $products->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item ">
                                            {!! $products->more_description !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <link
                                            href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
                                            rel="stylesheet">
                                        <div class="container">
                                            @if(!\Illuminate\Support\Facades\Auth::check())

                                            @endif
                                            @if($check_reviews->count() > 0)
                                                <div class="be-comment-block">
                                                    <form action="" method="post">
                                                        @csrf
                                                        <div class="my-3">
                                                            <div id="rating">
                                                                <input type="radio" id="star5" name="rating" value="5"/>
                                                                <label class="full" for="star5"
                                                                       title="Awesome - 5 stars"></label>

                                                                <input type="radio" id="star4" name="rating" value="4"/>
                                                                <label class="full" for="star4"
                                                                       title="Pretty good - 4 stars"></label>

                                                                <input type="radio" id="star3" name="rating" value="3"/>
                                                                <label class="full" for="star3"
                                                                       title="Meh - 3 stars"></label>

                                                                <input type="radio" id="star2" name="rating" value="2"/>
                                                                <label class="full" for="star2"
                                                                       title="Kinda bad - 2 stars"></label>

                                                                <input type="radio" id="star1" name="rating" value="1"/>
                                                                <label class="full" for="star1"
                                                                       title="Sucks big time - 1 star"></label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="md-form md-outline">
                                                            <label for="description">Đánh giá : </label>
                                                            <textarea id="description" name="description"
                                                                      class="md-textarea form-control pr-6" rows="4"
                                                                      placeholder="Viết cảm nghĩ của bạn..."></textarea>
                                                        </div>
                                                        <br>

                                                        <div class="pb-2">
                                                            <button type="button" id="btn-add-review" name="submit"
                                                                    class="btn btn-primary">Đăng
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                            @if(count($reviews) >0)
                                                <div class="be-comment-block">
                                                    <h1 class="comments-title">Đánh giá</h1>
                                                    @foreach($reviews as $review)
                                                        <div class="be-comment">
                                                            <div class="be-img-comment">
                                                                <img
                                                                    src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                                    alt="" class="be-ava-comment">
                                                            </div>
                                                            <div class="be-comment-content">
                                                                <span class="be-comment-name">
                                                                    <a href="javascript:void(0)">
                                                                        {{$review->name}}
                                                                        @if($review->rate == 5)
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                        @elseif($review->rate == 4)
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                        @elseif($review->rate == 3)
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                        @elseif($review->rate == 2)
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                        @elseif($review->rate == 1)
                                                                            <i class="fa fa-star fa-1x text-warning"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                            <i class="fa fa-star fa-1x text-muted"></i>
                                                                        @endif
                                                                    </a>
                                                                </span>
                                                                <span class="be-comment-time">
                                                                    <i class="fa fa-clock-o"></i>
                                                                    {{$review->created_at}}
                                                                </span>

                                                                <p class="be-comment-text">
                                                                    {{$review->description}}
                                                                    @if(\Illuminate\Support\Facades\Auth::id() == $review->id)
                                                                        <a href="javascript:void(0)" data-delete="{{$review->review_id}}" id="btn-delete-review" class="float-right"><i class="fa fa-trash-o" style="font-size: 20px" aria-hidden="true"></i></a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-warning" role="alert">
                                                    Hiện tại chưa có đánh giá !
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản Phẩm Liên Quan</h3>
                </div>
            </div>
            <div class="row">
                @foreach($related_products as $rl_product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <a href="{{route('product-detail', $rl_product->id)}}">
                                <div class="product__item__pic set-bg"
                                     data-setbg="../images/product/{{$rl_product->avatar}}">
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6>{{$rl_product->name}}</h6>
                                <a href="{{route('product-detail', $rl_product->id)}}" class="add-cart">Xem Chi Tiết</a>

                                @if(!empty($rl_product->promotion_price))
                                    <h5>{{number_format($rl_product->original_price - $rl_product->original_price * ($rl_product->promotion_price/100)) }}đ <sup>
                                            <del>{{number_format($rl_product->original_price)}}đ</del>
                                        </sup></h5>
                                @else
                                    <h5>{{number_format($rl_product->original_price)}}đ</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->

    <script src="../user/js/jquery-3.3.1.min.js"></script>
    <script src="../user/js/jquery.nice-select.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#btn-add-to-cart', function (e) {
                var form_data = new FormData();
                var size = $('input[type="radio"][name="size"]:checked').val();
                var color = $('input[type="radio"][name="color"]:checked').val();
                var quantity = $('input[name="quantity"]').val();
                var product_id = $('input[name="product_id"]').val();
                var name = $('input[name="name"]').val();

                console.log(size, color);
                form_data.append('size', size);
                form_data.append('color', color);
                form_data.append('quantity', quantity);
                form_data.append('product_id', product_id);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('add-to-cart')}}',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        //console.log(data);
                        if (data.success === 200) {
                            Swal.fire({
                                title: 'Thành Công!',
                                text: name + ' đã thêm thành công!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/products';
                                }
                            });
                        } else if (data.success == 201) {
                            Swal.fire({
                                title: 'Thất bại',
                                text: 'Vui lòng quay lại sau',
                                icon: 'error',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }else if (data.success == 302) {
                            window.location.href = '/login';
                        }
                        else {
                            //console.log(data.error)
                            printErrorMsg(data.error);
                            window.setTimeout(function () {
                                $(".print-error-msg").css('display', 'none');
                            }, 10000);
                        }
                    }, error: function (request, status, error) {
                        var err = eval("(" + request.responseText + ")");
                        //alert(err.message);
                        $(".print-error-msg").html('');
                        $(".print-error-msg").css('display', 'block');
                        $(".print-error-msg").append('<div class="alert alert-danger" role="alert">' + err.message + '</div>');
                    }
                })

            });

            function printErrorMsg(msg) {
                var html = '';
                $(".print-error-msg").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function (key, value) {
                    html += '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    html += value;
                    html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    html += '<span aria-hidden="true">&times;</span>';
                    html += '</button>';
                    html += '</div>';
                });
                $(".print-error-msg").append(html);
            }

            $(document).on('click', '#btn-add-review', function (e) {
                var form_data = new FormData();
                var rating = $('input[type="radio"][name="rating"]:checked').val();
                var description = $('textarea#description').val();
                //console.log(description, rating);
                form_data.append('rating', rating);
                form_data.append('description', description);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('add_review', $products->id)}}',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        //console.log(data);
                        if (data.success === 200) {
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Cảm ơn bạn đã đánh giá!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else if (data.success == 201) {
                            Swal.fire({
                                title: 'Thất bại',
                                text: 'Vui lòng quay lại sau',
                                icon: 'error',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {

                        }
                    }, error: function (request, status, error) {
                        var err = eval("(" + request.responseText + ")");
                        //alert(err.message);
                        $(".print-error-msg").html('');
                        $(".print-error-msg").css('display', 'block');
                        $(".print-error-msg").append('<div class="alert alert-danger" role="alert">' + err.message + '</div>');
                    }
                })
            });

            $(document).on('click', '#btn-delete-review', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Xóa',
                    text: "Bạn có muốn xóa không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#88ca3b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data("delete");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'delete_review/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Đánh giá đã xóa thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.reload();
                                        }
                                    });
                                }else if(data.success == 201){
                                    Swal.fire({
                                        title: 'Thất bại',
                                        text: 'Vui lòng quay lại sau',
                                        icon: 'error',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.reload();
                                        }
                                    });
                                }
                            }, error: function (request, status, error) {
                                var err = eval("(" + request.responseText + ")");
                                //alert(err.message);
                                $(".print-error-msg").html('');
                                $(".print-error-msg").css('display','block');
                                $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+err.message+'</div>');
                            }
                        })
                    }
                });
            });

        });
    </script>

@endsection
