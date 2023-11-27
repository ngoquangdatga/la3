@extends('users')
@section('title', 'Giỏ hàng')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <span>
                                Giỏ hàng
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{route('update_cart')}}" id="updateCart" method="POST">
                        @csrf
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng Tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($products->count() > 0)
                                        @foreach($products as $product)
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <a href="{{route('product-detail', $product->id)}}">
                                                            <img src="../images/product/{{$product->avatar}}" alt="" width="80px">
                                                        </a>
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <a href="{{route('product-detail', $product->id)}}">
                                                            <h6>{{$product->name}}</h6>
                                                        </a>
                                                        @if(!empty($product->promotion_price))
                                                            <h5>{{number_format($product->original_price - $product->original_price * ($product->promotion_price/100)) }}đ</h5>
                                                        @else
                                                            <h5>{{number_format($product->original_price)}}đ</h5>
                                                        @endif
                                                        <h6>Màu: {{$product->color}} <br>Kích thước: {{$product->size}}</h6>
                                                    </div>

                                                </td>

                                                <input type="hidden" name="cart_id[]" value="{{$product->cart_id}}">
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="text" name="quantity[]" value="{{$product->quantity}}">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="cart__price">
                                                    @if(!empty($product->promotion_price))
                                                        {{number_format(($product->original_price - $product->original_price * ($product->promotion_price/100)) * $product->quantity) }} đ
                                                    @else
                                                        {{number_format($product->original_price * $product->quantity)}} đ
                                                    @endif
                                                </td>
                                                <td class="cart__close">
                                                    <form action="" method="POST" id="removeCart">
                                                        @csrf
                                                        <input type="hidden" name="id"  value="{{$product->cart_id}}">
                                                        <button type="button" data-delete="{{$product->cart_id}}" id="btn-delete-cart"><i class="fa fa-close"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert alert-danger" role="alert">
                                                    Hiện tải giỏ hàng đang trống!
                                                </div>
                                            </td>
                                        </tr>
                                    @endempty
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="/products">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                @if($products->count() > 0)
                                    <div class="continue__btn update__btn">
                                        <a href="javascript:void(0)" id="btn-update-cart"><i class="fa fa-spinner"></i>Cập nhật giỏ hàng</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Tổng tiền giỏ hàng</h6>
                        <ul>
                            <li>Tổng : <span>{{number_format($total)}}đ</span></li>
                        </ul>
                        @if($products->count() > 0)
                            <a href="{{route('checkout')}}" class="primary-btn">Đặt Hàng</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <script src="../user/js/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#btn-update-cart', function(e){
                Swal.fire({
                    title: 'Cập nhật',
                    text: "Bạn có muốn cập nhật giỏ hàng không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#88ca3b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có',
                    cancelButtonText: 'Không',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#updateCart').submit();
                    }
                });
            });

            $(document).on('click', '#btn-delete-cart', function(e){
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
                            url : '/remove_cart/'+id,
                            type: 'GET',
                            data: id,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                console.log(data);
                                if(data.success === 200){
                                    Swal.fire({
                                        title: 'Thành Công!',
                                        text: 'Giỏ hàng đã xóa thành công!',
                                        icon: 'success',
                                        confirmButtonText: "Oke",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    }).then((result) => {
                                        if (result.isConfirmed){
                                            window.location.reload();
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
                                            window.location.reload();
                                        }
                                    });
                                }
                            }
                        })
                    }
                });

            });
        });
    </script>

@endsection
