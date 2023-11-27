@extends('users')
@section('content')
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-12 bg-white p-5">
                <h3 class="pb-3">Cài đặt lại mật khẩu</h3>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="form-style">
                    <form action="{{route('forget_password')}}" method="POST">
                        @csrf
                        <div class="form-group pb-3">
                            <label for="">Nhập email : </label>
                            <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <div class="pb-2">
                            <button type="submit"  class="btn btn-dark w-100 font-weight-bold mt-2">Gửi link về email</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
