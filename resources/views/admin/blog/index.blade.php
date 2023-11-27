@extends('admin')
@section('title', 'Thêm Bài Viết')
@section('content')
    <style>
        .select2-container--default .select2-selection--single{
            height: 40px !important;
        }
    </style>
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
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select2Single">Tên Danh Mục</label>
                                        <select class="select2-single form-control" name="category" id="select2Single">
                                            <option value="">Chọn Tên Danh Mục</option>
                                            @foreach($category as $category_list)
                                                <option value="{{$category_list->id}}">{{$category_list->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Tiêu Đề</label>
                                        <input type="text" class="form-control" name="title" id="" aria-describedby="" placeholder="Nhập Tiêu Đề">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="">Hình ảnh</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="images" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Chọn Hình Ảnh</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-outline">
                                        <label for="">Nội Dung</label> <br>
                                        <textarea name="content" class="compose-textarea" cols="80" rows="20"  id="content"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="btn-add-blog" class="btn btn-primary">Đăng</button>
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
            $(document).on('click', '#btn-add-blog', function (e) {
                e.preventDefault();
                var form_data = new FormData();
                var category = $('#select2Single').val();
                var title = $('input[name="title"]').val();
                var content =  $('textarea#content').val();
                var images =  $('#customFile')[0].files[0];

                form_data.append('category', category);
                form_data.append('title', title);
                form_data.append('content', content);
                form_data.append('images', images);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('admin/blog/create')}}',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if(data.success === 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Bài viết đã thêm thành công!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/admin/blog';
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
                                    window.location.href = '/admin/blog';
                                }
                            });
                        }  else{
                            printErrorMsg(data.error);
                        }
                    }, error: function (request, status, error) {
                        var err = eval("(" + request.responseText + ")");
                        //alert(err.message);
                        $(".print-error-msg").html('');
                        $(".print-error-msg").css('display','block');
                        $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+err.message+'</div>');
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
