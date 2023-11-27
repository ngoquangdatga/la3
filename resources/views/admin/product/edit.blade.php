@extends('admin')
@section('title', 'Sửa Sản Phẩm')
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
                        <h6 class="m-0 font-weight-bold text-primary">Cập Nhật Sản Phẩm</h6>
                    </div>
                    <div class="card-body">
                        <form action="admin/product/update/{{$products->id}}" method="post" enctype="multipart/form-data">
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
                                                <option value="{{$cate_product->id}}">{{$cate_product->name}}</option>
                                                <option value="">Chọn Tên Danh Mục</option>
                                                @foreach($category as $category_list)
                                                    @if($category_list->id != $cate_product->id)
                                                        <option value="{{$category_list->id}}">{{$category_list->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Tên Sản Phẩm</label>
                                            <input type="text" class="form-control" name="product" id="" aria-describedby="" placeholder="Nhập Sản Phẩm" value="{{$products->name}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Giá Sản Phẩm</label>
                                            <input type="text" class="form-control" name="original_price" id="" aria-describedby="" placeholder="Nhập Giá" value="{{$products->original_price}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="touchSpin1">Số Lượng</label>
                                            <input id="touchSpin1" name="quantity" type="text" class="form-control" value="{{$products->quantity}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="promotion_price">Giảm Giá : (%)</label>
                                            <select class="form-control" id="promotion_price" name="promotion_price">
                                                @php
                                                    $a = 100;
                                                    for ($i = 0; $i <= 100; $i ++){
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        $a--;
                                                    }
                                                @endphp
                                            </select>
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
                                                <input type="hidden" name="avatar_hidden" value="{{$products->avatar}}">
                                            </div>
                                            <div id="input">
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img1" class="custom-file-input" id="customFile1">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                    <input type="hidden" name="img1_hidden" value="{{$products->img1}}">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img2" class="custom-file-input" id="customFile2">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                    <input type="hidden" name="img2_hidden" value="{{$products->img2}}">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">Hình ảnh</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="img3" class="custom-file-input" id="customFile3">
                                                        <label class="custom-file-label" for="customFile1">Chọn Hình Ảnh</label>
                                                    </div>
                                                    <input type="hidden" name="img3_hidden" value="{{$products->img3}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-outline">
                                        <label for="">Bảng Size</label> <br>
                                        <div class="form-outline">
                                            <label for="">Mô tả thêm</label> <br>
                                            <textarea name="more_description" class="compose-textarea" cols="80" rows="20"  id="more_descr">
                                                {{$products->more_description}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-outline">
                                        <label for="">Mô tả</label> <br>
                                        <textarea name="description" class="compose-textarea" cols="80" rows="20"  id="description">
                                            {{$products->description}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="btn-update-product" class="btn btn-success">Cập Nhật</button>
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

            $(document).on('click', '#btn-update-product', function (e) {
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
                        var more_description = $('textarea#more_descr').val();
                        var product = $('input[name="product"]').val();
                        var description = $('textarea#description').val();
                        var quantity = $('#touchSpin1').val();
                        var original_price = $('input[name="original_price"]').val();
                        var promotion_price = $('#promotion_price').val();
                        var category = $('#select2Single').val();
                        var avatar =  $('#customFile')[0].files[0];
                        var img1 =  $('#customFile1')[0].files[0];
                        var img2 =  $('#customFile2')[0].files[0];
                        var img3 =  $('#customFile3')[0].files[0];

                        var avatar_hidden =  $('input[name="avatar_hidden"]').val();
                        var img1_hidden =  $('input[name="img1_hidden"]').val();
                        var img2_hidden =  $('input[name="img2_hidden"]').val();
                        var img3_hidden =  $('input[name="img3_hidden"]').val();


                        form_data.append('more_description', more_description);
                        form_data.append('description', description);
                        form_data.append('quantity', quantity);
                        form_data.append('original_price', original_price);
                        form_data.append('promotion_price', promotion_price);
                        form_data.append('category', category);
                        form_data.append('avatar', avatar);
                        form_data.append('product', product);
                        form_data.append('img1', img1);
                        form_data.append('img2', img2);
                        form_data.append('img3', img3);

                        form_data.append('avatar_hidden', avatar_hidden);
                        form_data.append('img1_hidden', img1_hidden);
                        form_data.append('img2_hidden', img2_hidden);
                        form_data.append('img3_hidden', img3_hidden);

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'admin/product/update/{{$products->id}}',
                            type: 'POST',
                            data: form_data,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Sản phẩm đã cập nhật thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.href = '/admin/product/show';
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
                                            window.location.href = '/admin/product/show';
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
