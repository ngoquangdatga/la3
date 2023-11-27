@extends('admin')
@section('title', 'Sửa Danh Mục')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Mục</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sửa Danh Mục</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Sửa Danh Mục
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="print-error-msg" style="display:none">
                                </div>
                            </div>
                        </div>
                        <form action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên Danh Mục</label>
                                <input type="text" class="form-control" name="name_category" id="" aria-describedby="" placeholder="Nhập Danh Mục" value="<?php if(isset($category)){echo $category->name;} ?>">
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Chọn Hình Ảnh</label>
                                </div>
                                <input type="hidden" name="images_hidden" value="<?php if(isset($category)){ echo $category->images;}?>">
                            </div>
                            <button type="button" id="btn-update-category" class="btn btn-primary">
                                Sửa Danh Mục
                            </button>
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
            $(document).on('click', '#btn-update-category', function (e) {
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
                        var name_category = $('input[name="name_category"]').val();
                        var images_hidden = $('input[name="images_hidden"]').val();
                        var images =  $('#customFile')[0].files[0];

                        form_data.append('name_category', name_category);
                        form_data.append('images', images);
                        form_data.append('images_hidden', images_hidden);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'admin/category/update/{{$category->id}}',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Danh mục đã sửa thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.href = '/admin/category/show';
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
                                            window.location.href = '/admin/category/show';
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
