@extends('users')
@section('title', 'Liên Hệ')
@section('content')
    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.8257195206315!2d107.32124741538748!3d16.785344224305284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31411d4845400ca9%3A0x9ed265ae4a97e3f2!2zS2jhuqNpIFRr!5e0!3m2!1sen!2s!4v1639015738200!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Thông tin</span>
                            <h2>Liên Hệ</h2>
                        </div>
                        <ul>
                            <li>
                                <h4>Quảng Trị</h4>
                                <p>Hải An - Hải Lăng - Quảng Trị<br />+84 695 824 252</p>
                            </li>
                            <li>
                                <h4>Đà Nẵng</h4>
                                <p>Hải Châu - Đà Nẵng<br />+84 695 824 252</p>
                            </li>
                            <li>
                                <h4>TP.Hồ Chí Minh</h4>
                                <p>Q.8 - TP.Hồ Chí Minh<br />+84 695 824 252</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="{{route('send_contact')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Họ Tên">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Tin nhắn"></textarea>
                                    <button type="submit" class="site-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
