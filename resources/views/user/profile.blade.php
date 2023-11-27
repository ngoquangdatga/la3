@extends('users')
@section('content')
    <style>
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }
    </style>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang Chủ</a>
                            <span>Thông Tin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <br> <br>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                Đổi mật khẩu
                            </button>
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{$users->name}}</h4>
                                    <p class="text-secondary mb-1">{{$users->phone}}</p>
                                    <p class="text-muted font-size-sm">{{$users->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="print-error-msg" style="display:none">

                    </div>
                    <form action="{{route('change_pwd')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu cũ: </label>
                            <input type="password" class="form-control" name="password_old" id="exampleInputPassword1" placeholder="Mật khẩu cũ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu mới:</label>
                            <input type="password" class="form-control" name="password_new" id="exampleInputPassword1" placeholder="Mật khẩu mới">
                        </div>
                        <button type="button" id="btn-change" class="btn btn-success">Đồng ý</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../user/js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-change', function (e) {
                e.preventDefault();
                var password_old = $('input[name="password_old"]').val();
                var password_new = $('input[name="password_new"]').val();


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('change_pwd')}}',
                    type: 'POST',
                    data:{
                        'password_old' : password_old,
                        'password_new' : password_new,
                    },
                    success: function (data) {
                        if(data.success == 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Mật khẩu đã thay đổi!',
                                icon: 'success',
                                confirmButtonText: "Oke",
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
                                    window.location.href = '/';
                                }
                            });
                        }else if(data.success == 202){
                            $(".print-error-msg").html('');
                            $(".print-error-msg").css('display','block');
                            $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
                        }
                        else{
                            printErrorMsg(data.error);
                        }
                    }
                })

            });
            function printErrorMsg (msg) {
                $(".print-error-msg").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+value+'</div>');
                });
            }
        });
    </script>


@endsection
