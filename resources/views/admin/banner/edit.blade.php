@extends('admin')
@section('title', 'Sửa Banner')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bài Viết</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bài Viết</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm Bài Viết</h6>
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
                                <input type="text" class="form-control" name="title" id="" aria-describedby="" value="{{$banner->title}}" placeholder="Nhập Tiêu Đề">
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Chọn Hình Ảnh</label>
                                </div>
                                <input type="hidden" name="images_hidden" value="{{$banner->images}}">
                            </div>
                            <button type="button" id="btn-update-banner" class="btn btn-primary">Đăng</button>
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
            $(document).on('click', '#btn-update-banner', function (e) {
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
                        var title = $('input[name="title"]').val();
                        var images =  $('#customFile')[0].files[0];
                        var images_hidden = $('input[name="images_hidden"]').val();

                        console.log(images);
                        form_data.append('title', title);
                        form_data.append('images', images);
                        form_data.append('images_hidden', images_hidden);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'admin/banner/update/{{$banner->id}}',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Banner đã cập nhật thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.href = '/admin/banner/show';
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
                                            window.location.href = '/admin/banner/show';
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
