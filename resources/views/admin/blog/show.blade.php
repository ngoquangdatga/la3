@extends('admin')
@section('title', 'Danh Sách Bài Viết')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Sách Bài Viết</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh Sách Bài Viết</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Bài Viết</h6>
                    </div>
                   <div class="col-sm-12">
                       <form action="{{route('admin/blog/show')}}" method="GET">
                           <div class="form-group">
                               <label for="">Tìm Kiếm : </label>
                               <input type="text" class="form-control" id="" name="search" placeholder="Nhập tiêu đề">
                           </div>
                           <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                       </form>
                   </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="print-error-msg" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="">
                            <thead class="thead-light">
                            <tr>
                                <th>Hình Ảnh</th>
                                <th>Tiêu Đề</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td><img src="../images/blog/{{$blog->images}}" width="50px" alt=""></td>
                                        <td>{{$blog->title}}</td>
                                        <td>{{$blog->created_at}}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-edit="{{$blog->id}}" id="btn-edit-blog" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-delete="{{$blog->id}}" id="btn-delete-blog" class="btn btn-danger">
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
                            {{$blogs->links()}}
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
            $(document).on('click', '#btn-delete-blog', function (e) {
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
                            url : 'admin/blog/delete/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Bài viết đã xóa thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.href = '/admin/blog/show';
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
                                            window.location.href = '/admin/blog/show';
                                        }
                                    });
                                }
                            }
                        })
                    }
                });
            });

            $(document).on('click', '#btn-edit-blog', function (e) {
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
                        window.location.href = 'admin/blog/edit/'+id;
                    }
                });
            });
        });
    </script>
@endsection
