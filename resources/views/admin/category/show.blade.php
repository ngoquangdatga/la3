@extends('admin')
@section('title', 'Danh Sách Danh Mục')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Sách Danh Mục</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh Sách Danh Mục</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Danh Mục</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <form action="{{route('admin/category/show')}}" method="GET">
                            <div class="form-group">
                                <label for="">Tìm Kiếm : </label>
                                <input type="text" class="form-control" id="" name="search" placeholder="Nhập tên danh mục">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="print-error-msg" style="display:none">
                                </div>
                            </div>
                        </div>
                        <table class="table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tên Danh Mục</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($category->count() > 0)
                                @foreach($category as $category_list)
                                    <tr>
                                        <td><img src="../images/category/{{$category_list->images}}" width="50px" alt=""></td>
                                        <td>{{$category_list->name}}</td>
                                        <td>{{$category_list->created_at}}</td>
                                        <td>
                                            <button  type="button" id="btn-edit" data-edit="{{$category_list->id}}" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" id="btn-delete" data-delete="{{$category_list->id}}" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-danger" role="alert">
                                            Hiện tại đang trống!
                                        </div>
                                    </td>
                                </tr>
                            @endempty
                            </tbody>
                        </table>

                    </div>
                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center">
                            {{$category->links()}}
                        </div>
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
            $(document).on('click', '#btn-delete', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Xóa',
                    text: "Bạn có muốn xóa không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#88ca3b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data("delete");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : 'admin/category/delete/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Danh mục đã thêm thành công!',
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
                                }
                            }, error: function (request, status, error) {
                                var err = eval("(" + request.responseText + ")");
                                //alert(err.message);
                                $(".print-error-msg").html('');
                                $(".print-error-msg").css('display','block');
                                $(".print-error-msg").append('<div class="alert alert-danger" role="alert">'+err.message+'</div>');
                            }
                        })
                    }
                });
            });

            $(document).on('click', '#btn-edit', function (e) {
                e.preventDefault();
                //var id = $(this).data("edit");
                Swal.fire({
                    title: 'Sửa',
                    text: "Bạn có muốn sửa không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#88ca3b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data("edit");
                        window.location.href = 'admin/category/edit/'+id;
                    }
                });
            });
        });
    </script>
@endsection
