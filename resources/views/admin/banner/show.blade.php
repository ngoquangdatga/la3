@extends('admin')
@section('title', 'Danh Sách Banner')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Sách Banner</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh Sách Banner</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Banner</h6>
                    </div>
                    <div class="col-sm-12">
                        <form action="{{route('admin/banner/show')}}" method="GET">
                            <div class="form-group">
                                <label for="">Tìm Kiếm : </label>
                                <input type="text" class="form-control" id="" name="search" placeholder="Nhập tiêu đề">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </form>
                        <br>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="">
                            <thead class="thead-light">
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tiêu Đề</th>
                                <th>Ngày</th>
                                <th>Thực Hiện</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td><img src="../images/banner/{{$banner->images}}" alt="" width="100px"></td>
                                        <td>{{$banner->title}}</td>
                                        <td>{{$banner->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-edit="{{$banner->id}}" id="btn-edit-banner" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-delete="{{$banner->id}}" id="btn-delete-banner" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center">
                            {{$banners->links()}}
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
            $(document).on('click', '#btn-delete-banner', function (e) {
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
                            url : 'admin/banner/delete/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Banner đã xóa thành công!',
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

            $(document).on('click', '#btn-edit-banner', function (e) {
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
                        window.location.href = 'admin/banner/edit/'+id;
                    }
                });
            });
        });
    </script>
@endsection
