@extends('users')
@section('content')
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img src="../user/img/login.jpg" class="img-fluid" style="min-height:100%;" />
            </div>
            <div class="col-md-6 bg-white p-5">
                <h3 class="pb-3">Đặt Lại Mật Khẩu</h3>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="form-style">
                    <form action="{{route('reset_password_post')}}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group pb-3">
                            <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group pb-3">
                            <input type="password" name="password" placeholder="Mật khẩu Mới" class="form-control" id="exampleInputPassword1">
                        </div>

                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                               Đặt Lại Mật Khẩu
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
