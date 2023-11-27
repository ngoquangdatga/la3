@extends('admin')
@section('title', 'Sửa Người Dùng')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sản Phẩm</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sửa Người Dùng</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="print-error-msg" style="display:none">
                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Người Dùng</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" aria-describedby="" placeholder="Nhập Sản Phẩm">
                            </div>
                            <div class="form-group">
                                <label for="">Gmail</label>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}" aria-describedby="" placeholder="Nhập Sản Phẩm">
                            </div>
                            <button type="button" id="btn-update-user" class="btn btn-success">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
    <script src="../admin/vendor/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-update-user', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Cập Nhật',
                    text: "Bạn có muốn cập nhật không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#88ca3b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form_data = new FormData();
                        var name = $('input[name="name"]').val();
                        var email = $('input[name="email"]').val();

                        form_data.append('name', name);
                        form_data.append('email', email);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'admin/user/update/{{$user->id}}',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Người dùng đã cập nhật thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.href = '/admin/user';
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
                                            window.location.href = '/admin/user';
                                        }
                                    });
                                }  else{
                                    printErrorMsg(data.error);
                                }
                            }
                        })
                    }
                });

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
