@extends('users')
@section('content')
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img src="../user/img/login.jpg" class="img-fluid" style="min-height:100%;" />
            </div>
            <div class="col-md-6 bg-white p-5">
                <h3 class="pb-3">Đăng nhập</h3>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="form-style">
                    <form action="{{route('login')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group pb-3">
                            <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group pb-3">
                            <input type="password" name="password" placeholder="Mật khẩu" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center"></div>
                            <div><a href="{{route('forget_password')}}">Quên mật khẩu?</a></div>
                        </div>
                        <div class="pb-2">
                            <button type="button" id="btn-login" class="btn btn-dark w-100 font-weight-bold mt-2">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="sideline">hoặc</div>
                    <div>
                        <a href="{{ url('google') }}" class="btn btn-danger w-100 font-weight-bold mt-2"><i class="fa fa-google-plus" aria-hidden="true"></i> Đăng nhập bằng Google</a>
                    </div>
                    <div class="pt-4 text-center">
                        Bạn chưa có tài khoản <a href="/signin">Đăng ký</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../user/js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#btn-login', function(e){
                var email       = $('input[name="email"]').val();
                var password    = $('input[name="password"]').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('login')}}',
                    type: 'POST',
                    data:{
                        'email' : email,
                        'password': password,
                    },
                    success: function (data) {
                        if(data.success == 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Đăng nhập đã thành công!',
                                icon: 'success',
                                confirmButtonText: "Trang Chủ",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/';
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
                                    window.location.href = '/login';
                                }
                            });
                        }
                        else{
                            printErrorMsg(data.error);
                        }
                    }
                })

            });
            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>
@endsection
