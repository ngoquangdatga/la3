<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="../user/img/logo.png" alt=""></a>
                    </div>
                    <a href="#"><img src="../user/img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Danh Mục</h6>
                    <ul>
                        @foreach(\App\Category::all() as $cg)
                            <li><a href="category/{{$cg->id}}">{{$cg->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Chính sách</h6>
                    <ul>
                        <li><a href="/return_policy">Chính sách đổi hàng</a></li>
                        <li><a href="/warranty_policy"> Chính sách bảo hành</a></li>
                        <li><a href="/privacy_policy">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>FAQ</h6>
                    <ul>
                        <li><a href="/payment_delivery">Thanh toán và giao nhận</a></li>
                        <li><a href="/size_guide"> Hướng dẫn chọn size</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <p>Copyright ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
