<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{asset('')}}">
    <link href="admin/img/logo/logo.png" rel="icon">
    <title>Đăng Nhập - Admin</title>
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="admin/css/ruang-admin.min.css" rel="stylesheet">
    <!-- Sweetalert2 - Alert box -->
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="bg-gradient-login">
<!-- Login Content -->
<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Đăng Nhập - Trang Quản Lý</h1>
                                </div>
                                <div class="col-lg-12">
                                    <div class="print-error-msg" style="display:none">
                                    </div>
                                </div>
                                <form action="" method="POST" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email"  name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Nhập Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Nhập Mật Khẩu">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="btn-login" class="btn btn-primary btn-block">Đăng Nhập</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <h5 id="version-ruangadmin"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Content -->
<script src="admin/vendor/jquery/jquery.min.js"></script>
<script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="admin/js/ruang-admin.min.js"></script>
<!-- Sweetalert2 - Alert box -->
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn-login', function (e) {
            e.preventDefault();
            var email = $('input[name="email"]').val();
            var password = $('input[name="password"]').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : 'admin/login',
                type: 'POST',
                data:{
                    'email' : email,
                    'password' : password,
                },
                success: function (data) {
                    console.log(data);
                    if(data.success === 200){
                        Swal.fire({
                            title: 'Thành Công!',
                            text: 'Chào mừng đến trang quản lý',
                            icon: 'success',
                            confirmButtonText: "Oke",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = '/admin/home';
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
                                window.location.href = '/admin/index';
                            }
                        });
                    }  else{
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
</body>
</html>
