@extends('admin')
@section('title', 'Trang Chủ')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang Chủ</h1>
            <ol class="breadcrumb">
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Tổng Tất Cả</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total)}} đ</div>
{{--                                <div class="mt-2 mb-0 text-muted text-xs">--}}
{{--                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
{{--                                    <span>Since last month</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Số Lượng Sản Phẩm</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count_products}}</div>
{{--                                <div class="mt-2 mb-0 text-muted text-xs">--}}
{{--                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>--}}
{{--                                    <span>Since last years</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Số Lượng Người Dùng</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$count_users}}</div>
{{--                                <div class="mt-2 mb-0 text-muted text-xs">--}}
{{--                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>--}}
{{--                                    <span>Since last month</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Yêu cầu đang xử lý</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_request}}</div>
{{--                                <div class="mt-2 mb-0 text-muted text-xs">--}}
{{--                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>--}}
{{--                                    <span>Since yesterday</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Trạng thái sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Số Lượng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><a href="{{route('admin/product/edit', $product->id)}}">{{$product->name}}</a></td>
                                    <td>
                                        {{$product->quantity}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a class="m-0 small text-primary card-link" href="{{'/admin/product/show'}}">Xem thêm<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Invoice Example -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Hóa Đơn</h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="{{route('admin/bill')}}">Xem Thêm<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Khách Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Thực Hiện</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$bill->name}} <br>{{$bill->phone}}</td>
                                    <td>{{number_format($bill->total)}} đ</td>
                                    <td>
                                        @if($bill->status == 'Đang xử lý')
                                            <span class="badge badge-danger">{{$bill->status}}</span>
                                        @elseif($bill->status == 'Đã giao hàng')
                                            <span class="badge badge-success">{{$bill->status}}</span>
                                        @elseif($bill->status == 'Đang vận chuyển')
                                            <span class="badge badge-warning">{{$bill->status}}</span>
                                        @endif
                                    </td>
                                    <td><a href="admin/bill/{{$bill->id}}" class="btn btn-primary">Chi tiết</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to logout?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                        <a href="login.html" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!---Container Fluid-->
@endsection
