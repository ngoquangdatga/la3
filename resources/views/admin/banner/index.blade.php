@extends('admin')
@section('title', 'Thêm Banner')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Banner</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm Banner</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm Banner</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="print-error-msg" style="display:none">
                                </div>
                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Tiêu Đề</label>
                                <input type="text" class="form-control" name="title" id="" aria-describedby="" placeholder="Nhập Tiêu Đề">
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Chọn Hình Ảnh</label>
                                </div>
                            </div>
                            <button type="button" id="btn-add-banner" class="btn btn-primary">Thêm Banner</button>
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
            $(document).on('click', '#btn-add-banner', function (e) {
                e.preventDefault();
                var form_data = new FormData();
                var title = $('input[name="title"]').val();
                var images =  $('#customFile')[0].files[0];

                console.log(images);
                form_data.append('title', title);
                form_data.append('images', images);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('admin/banner/create')}}',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if(data.success === 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Banner đã thêm thành công!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/admin/banner';
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
                                    window.location.href = '/admin/banner';
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
@endsection
