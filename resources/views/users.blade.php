<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>

    <base href="{{asset('')}}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../user/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../user/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../user/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../user/css/magnific-popup.css" type="text/css">
    {{--    <link rel="stylesheet" href="../user/css/nice-select.css" type="text/css">--}}
    {{--    <script src="../user/js/jquery.nice-select.min.js"></script>--}}
    <link rel="stylesheet" href="../user/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../user/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../user/css/style.css" type="text/css">
    <!-- Sweetalert2 - Alert box -->
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.css">
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>

<body>

<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            @if(Illuminate\Support\Facades\Auth::check())
                <div class="header__top__hover">
                    <span style="color: black">{{\Illuminate\Support\Facades\Auth::user()->name}}<i
                            class="arrow_carrot-down"></i></span>
                    <ul class="menu">
                        <li><a href="{{route('profile')}}">Thông tin</a></li>
                        <li><a href="{{route('shop_cart')}}">Giỏ hàng</a></li>
                        <li><a href="/order-status">Trạng thái đơn hàng</a></li>
                        <li><a href="/logout">Đăng xuất</a></li>
                    </ul>
                </div>
            @else
                <div class="header__top__links">
                    <a href="{{route('login')}}">Đăng nhập</a>
                </div>
            @endif

        </div>
    </div>
    <div class="offcanvas__nav__option">
        <?php
            $total_items = 0;
            use App\Http\Controllers\PageController;
            if (Illuminate\Support\Facades\Auth::check()) {
                $total_items = PageController::cartItem();
            }

            $total_price = 0;
            if (Illuminate\Support\Facades\Auth::check()) {
                $total_price = PageController::totalPrice();
            }
        ?>
        @if(Illuminate\Support\Facades\Auth::check())
            <a href="{{route('shop_cart')}}"><img src="../user/img/icon/cart.png" alt="">
                <span>
                    {{$total_items}}
                </span>
            </a>
            <div class="price">{{number_format($total_price)}}đ</div>
        @endif

        {{--        <a href="{{route('shop_cart')}}"><img src="" alt=""> <span>0</span></a>--}}
        {{--        <div class="price">$0.00</div>--}}
    </div>
    <div id="mobile-menu-wrap"></div>

</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    Khai TK
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        @if(Illuminate\Support\Facades\Auth::check())
                            <div class="header__top__hover">
                                <span>{{\Illuminate\Support\Facades\Auth::user()->name}}<i
                                        class="arrow_carrot-down"></i></span>
                                <ul class="menu">
                                    <li><a href="{{route('profile')}}">Thông tin</a></li>
                                    <li><a href="{{route('shop_cart')}}">Giỏ hàng</a></li>
                                    <li><a href="/order-status">Trạng thái đơn hàng</a></li>
                                    <li><a href="/logout">Đăng xuất</a></li>
                                </ul>
                            </div>
                        @else
                            <div class="header__top__links">
                                <a href="{{route('login')}}">đăng nhập</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="/"><img src="../user/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="/">Trang Chủ</a></li>
                        <li class="{{ (request()->is('products')) ? 'active' : '' }}"><a href="{{route('products')}}">Cửa
                                Hàng</a></li>
                        <li class="{{ (request()->is('abouts')) ? 'active' : '' }}"><a href="/abouts">Giới Thiệu</a>
                        </li>
                        <li class="{{ (request()->is('blogs')) ? 'active' : '' }}"><a href="{{route('blogs')}}">Bài
                                Viết</a></li>
                        <li class="{{ (request()->is('contacts')) ? 'active' : '' }}"><a href="{{url('contacts')}}">Liên
                                Hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 col-md-2">
                <?php
                $total_items = 0;

                if (Illuminate\Support\Facades\Auth::check()) {
                    $total_items = PageController::cartItem();
                }

                $total_price = 0;
                if (Illuminate\Support\Facades\Auth::check()) {
                    $total_price = PageController::totalPrice();
                }
                ?>
                @if(Illuminate\Support\Facades\Auth::check())
                    <div class="header__nav__option">
                        <a href="{{route('shop_cart')}}"><img src="../user/img/icon/cart.png" alt="">
                            <span>
                                {{$total_items}}
                            </span>
                        </a>
                        <div class="price">{{number_format($total_price)}}đ</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->

@yield('content')

<!-- Footer Section Begin -->
@include('user.footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="../user/js/jquery-3.3.1.min.js"></script>
<script src="../user/js/bootstrap.min.js"></script>
{{--<script src="../user/js/jquery.nice-select.min.js"></script>--}}
<script src="../user/js/jquery.nicescroll.min.js"></script>
<script src="../user/js/jquery.magnific-popup.min.js"></script>
<script src="../user/js/jquery.countdown.min.js"></script>
<script src="../user/js/jquery.slicknav.js"></script>
<script src="../user/js/mixitup.min.js"></script>
<script src="../user/js/owl.carousel.min.js"></script>
<!-- Sweetalert2 - Alert box -->
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="../user/js/main.js"></script>
</body>

</html>
