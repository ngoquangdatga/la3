@extends('users')
@section('title', 'Trạng thái đơn hàng')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Trạng thái đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <span>Trạng thái đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <tr>
                        <th>STT</th>
                        <th>Khách Hàng</th>
                        <th>Ngày</th>
                        <th>Tổng</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                    @if($bills->count() > 0)

                        @php
                            $i = 1;
                        @endphp
                        @foreach($bills as $bill)
                            @if($bill->status != 'Đã hủy đơn')
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$bill->name}}</td>
                                    <td>{{$bill->created_at->format('d/m/Y')}} </td>
                                    <td>{{number_format($bill->total)}}đ</td>
                                    <td>
                                        @if($bill->status == 'Đang xử lý')
                                            <span class="badge badge-danger">{{$bill->status}}</span>
                                        @elseif($bill->status == 'Đã giao hàng')
                                            <span class="badge badge-success">{{$bill->status}}</span>
                                        @elseif($bill->status == 'Đang vận chuyển')
                                            <span class="badge badge-warning">{{$bill->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="detail_bill/{{$bill->id}}" class="btn btn-success">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-danger" role="alert">
                                    Hiện tải trạng thái đơn hàng đang trống!
                                </div>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="col-sm-12">
                {{$bills->links()}}
            </div>
        </div>
    </div>

@endsection
