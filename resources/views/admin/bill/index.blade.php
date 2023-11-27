@extends('admin')
@section('title', 'Hóa Đơn')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hóa Đơn</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hóa Đơn</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh Sách Hóa Đơn</h6>
                    </div>
                    <div class="col-sm-12">
                        <form action="{{route('admin/bill')}}" method="GET">
                            <div class="form-group">
                                <label for="">Tìm Kiếm : </label>
                                <input type="text" class="form-control" id="" name="search" placeholder="Nhập tìm kiếm">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                        </form>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover text-center" id="">
                            <thead class="thead-light">
                            <tr>
                                <th>Khách Hàng</th>
                                <th>Địa chỉ</th>
                                <th>Tổng Tiền</th>
                                <th>Ngày Thanh Toán</th>
                                <th>Trạng Thái</th>
                                <th>Thực Hiện</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>{{$bill->name}}<br>{{$bill->phone}}</td>
                                        <td>{{$bill->address}}</td>
                                        <td>{{number_format($bill->total)}} đ</td>
                                        <td>{{$bill->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            @if($bill->status == 'Đã hủy đơn')
                                                <span class="badge badge-dark">{{$bill->status}}</span>
                                            @elseif($bill->status == 'Đang xử lý')
                                                <span class="badge badge-danger">{{$bill->status}}</span>
                                            @elseif($bill->status == 'Đã giao hàng')
                                                <span class="badge badge-success">{{$bill->status}}</span>
                                            @elseif($bill->status == 'Đang vận chuyển')
                                                <span class="badge badge-warning">{{$bill->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($bill->status == 'Đã hủy đơn')
                                                <a href="admin/bill/{{$bill->id}}" class="btn btn-primary disabled">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @else
                                                <a href="admin/bill/{{$bill->id}}" class="btn btn-primary">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-center">
                        <div class="d-flex justify-content-center">
                            {{$bills->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
