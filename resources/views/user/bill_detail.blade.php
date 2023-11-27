@extends('users')
@section('title', 'Chi Tiết đơn hàng')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="/user/css/print.css">
<div class="container">
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="row">
                <div class="text-left col-sm-6">
                    <a href="{{route('order-status')}}" class="btn btn-success">Quay lại</a>
                </div>
                <div class="text-right col-sm-6">
                    @if($customers->status == 'Đang xử lý')
                        <a href="{{route('destroy-order-status', $customers->id)}}" class="btn btn-danger">Hủy đơn hàng</a>
                    @endif
                </div>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto" id="dvContainer">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <h5 class="to">{{$customers->name}}</h5>
                            <div class="phone">{{$customers->phone}}</div>
                            <div class="address">{{$customers->address}}</div>
                            <div class="email">{{$customers->email}}</div>
                        </div>
                        <div class="col invoice-details">
{{--                            <div class="date">Ngày : {{ date('Y-m-d H:i:s') }}</div>--}}
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th class="text-left">Sản Phẩm</th>
                            <th class="text-right">Giá</th>
                            <th class="text-right">Số Lượng</th>
                            <th class="text-right">Tổng Tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($bills as $bill)
                            <tr>
                                <td class="no"><?php echo $i++ ?></td>
                                <td class="text-left"><h3><a href="{{route('product-detail', $bill->id)}}">{{$bill->name_product}}</a></h3>Kích thước : {{$bill->size}} - Màu : {{$bill->color}}</td>
                                <td class="unit">{{number_format($bill->original_price)}} đ</td>
                                <td class="qty">{{$bill->quantity}}</td>
                                <td class="total">{{number_format($bill->original_price * $bill->quantity)}} đ</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng Cộng</td>
                            <td>{{number_format($customers->total)}}đ</td>
                        </tr>
                        </tfoot>
                    </table>
                    <br>
                    <div class="thanks">Cảm ơn quý khách!</div>
                    <div class="notices">
                        <div>Lưu ý:</div>
                        <div class="notice">Khách hành được đổi trả sản phẩm sau 7 ngày.</div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@endsection
