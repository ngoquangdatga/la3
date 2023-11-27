@extends('admin')
@section('title', 'Thêm Sản Phẩm')
@section('content')
    <style>
        .select2-container--default .select2-selection--single{
            height: 40px !important;
        }
    </style>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sản Phẩm</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm Sản Phẩm</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm Sản Phẩm</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" id="form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="print-error-msg" style="display:none">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-12">
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" name="product" id="" aria-describedby="" placeholder="Nhập Sản Phẩm">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Giá Sản Phẩm</label>
                                            <input type="text" class="form-control" name="original_price" id="" aria-describedby="" placeholder="Nhập Giá">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="touchSpin1">Số Lượng</label>
                                            <input id="touchSpin1" name="quantity" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <label for="">Ảnh Đại Diện</label>
                                                <div class="custom-file input-append">
                                                    <input type="file" name="avatar" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Ảnh Đại Diện</label>
                                                </div>
                                            </div>
                                            <div id="input">
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img1" class="custom-file-input" id="customFile1">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img2" class="custom-file-input" id="customFile2">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img3" class="custom-file-input" id="customFile3">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-outline">
                                        <label for="">Mô tả thêm</label> <br>
                                        <textarea name="more_description" class="compose-textarea" cols="80" rows="20"  id="more_descr"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-outline">
                                        <label for="">Mô tả</label> <br>
                                        <textarea name="description" class="compose-textarea" cols="80" rows="20"  id="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="btn-add-product" class="btn btn-primary">Thêm</button>
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
            $(document).on('click', '#btn-add-product', function(e){

                var form_data = new FormData();
                var category = $('#select2Single').val();
                var product = $('input[name="product"]').val();
                var original_price = $('input[name="original_price"]').val();
                var quantity = $('#touchSpin1').val();
                var more_description = $('textarea#more_descr').val();
                var description = $('textarea#description').val();
                var avatar =  $('#customFile')[0].files[0];
                var img1 =  $('#customFile1')[0].files[0];
                var img2 =  $('#customFile2')[0].files[0];
                var img3 =  $('#customFile3')[0].files[0];

                console.log(category, product, original_price, quantity, avatar, img1, img2, img3, more_description, description);

                form_data.append('category', category);
                form_data.append('product', product);
                form_data.append('original_price', original_price);
                form_data.append('quantity', quantity);
                form_data.append('more_description', more_description);
                form_data.append('description', description);
                form_data.append('avatar', avatar);
                form_data.append('img1', img1);
                form_data.append('img2', img2);
                form_data.append('img3', img3);


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('admin/product/create')}}',
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        if(data.success === 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Sản Phẩm đã thêm thành công!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/admin/product';
                                }
                            });
                        }
                        else if(data.success == 201){
                            Swal.fire({
                                title: 'Thất bại',
                                text: 'Vui lòng quay lại sau',
                                icon: 'error',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/admin/product';
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
                $(".print-error-msg").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+value+'</div>');
                });
            }
        });
    </script>
@endsection
