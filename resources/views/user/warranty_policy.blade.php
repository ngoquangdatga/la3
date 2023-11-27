@extends('users')
@section('title', 'Chính sách bảo hành')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="../user/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Chính sách bảo hành</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p style="padding: 0px; outline: none; color: rgb(51, 51, 51); font-family: arial; font-size: 14px; text-align: justify;">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Bảo hành sản phẩm là khắc phục sự cố hư hỏng, sự cố kỹ thuật xảy ra do lỗi của nhà sản xuất.</span>
                    </p><h4
                        style="margin-right: auto; margin-left: auto; padding: 0px; outline: none; font-family: arial; color: rgb(51, 51, 51);">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(255, 0, 0);"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-weight: 700;">1. Thời gian bảo hành.</span></span>
                    </h4>
                    <p style="padding: 0px; outline: none; color: rgb(51, 51, 51); font-family: arial; font-size: 14px;">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">1 tháng kể từ ngày nhận hàng<span
                                style="margin: 0px auto; padding: 0px; outline: none; font-weight: 700;">.</span></span>
                    </p><h4
                        style="margin-right: auto; margin-left: auto; padding: 0px; outline: none; font-family: arial; color: rgb(51, 51, 51);">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(255, 0, 0);"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-weight: 700;">2. Điều kiện bảo hành.</span></span>
                    </h4>
                    <ul style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; outline: none; font-family: arial;">
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Các sản phẩm bảo hành phải còn mới, không bị dơ bẩn.</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sản phẩm bị thủng, rách… do lỗi của nhà sản xuất.</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sản phẩm bị in màu lem, bay màu, in sai quy cách.</span>
                        </li>
                    </ul>
                    <h4 style="margin-right: auto; margin-left: auto; padding: 0px; outline: none; font-family: arial; color: rgb(51, 51, 51);">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(255, 0, 0);"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-weight: 700;">3. Những trường hợp không được bảo hành.</span></span>
                    </h4>
                    <ul style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; outline: none; font-family: arial;">
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sử dụng sản phẩm sai với hướng dẫn sử dụng.</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sản phẩm bị hư do thiên tai, lũ lụt, hỏa hoạn….</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sản phẩm đã qua sử dụng bị dơ bẩn, đã được sữa chữa bởi người sử dụng.</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sản phẩm hư hỏng do tác động bên ngoài, biến dạng, rách thủng, ẩm mốc, cháy hoặc do con người sử dụng làm hỏng.</span>
                        </li>
                    </ul>
                    <h4 style="margin-right: auto; margin-left: auto; padding: 0px; outline: none; font-family: arial; color: rgb(51, 51, 51);">
                        <span
                            style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(255, 0, 0);"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-weight: 700;">4. Hình thức bảo hành.</span></span>
                    </h4>
                    <ul style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; outline: none; font-family: arial;">
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Thu hồi và sản xuất mới những sản phẩm không đạt yêu cầu.</span>
                        </li>
                        <li style="margin: 0px; padding: 0px; outline: none;"><span
                                style="margin: 0px auto; padding: 0px; outline: none; font-family: &quot;times new roman&quot;, times; font-size: 14pt; color: rgb(0, 0, 0);">Sửa lại những sản phẩm bị lỗi nhỏ.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
