@extends('admin')
@section('title', 'Danh Sách Người Dùng')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Người Dùng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Người Dùng</h6>
                    </div>
                    <div class="col-sm-12">
                        <form action="{{route('admin/user')}}" method="GET">
                            <div class="form-group">
                                <label for="">Tìm Kiếm : </label>
                                <input type="text" class="form-control" id="" name="search" placeholder="Nhập tên sản phẩm">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </form>
                        <br>
                    </div>
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
                                <th>Tên Người Dùng</th>
                                <th>Gmail</th>
                                <th>Thực Hiện</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-edit="{{$user->id}}" id="btn-edit-user" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" data-delete="{{$user->id}}" id="btn-delete-user" class="btn btn-danger">
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
                            {{$users->links()}}
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
            $(document).on('click', '#btn-edit-user', function (e) {
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
                        window.location.href = 'admin/user/edit/'+id;
                    }
                });
            });

            $(document).on('click', '#btn-delete-user', function (e) {
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
                            url : 'admin/user/delete/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Người dùng đã xóa thành công!',
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
        });
    </script>
@endsection
