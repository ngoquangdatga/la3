@extends('users')
@section('title', 'Thanh Toán')
@section('content')
<!-- Header Section End -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        .select-item{
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            margin: 15px auto;
            position: relative;
        }
        .select-item > label {
            display: block;
            font-size: 18px;
        }
        .select-item > select {
            margin-top: 10px;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            line-height: 36px;
            height: 36px;
            border-radius: 3px;
            outline: none;
            background: none;
            box-shadow: none;
            border: 1px solid rgb(175, 175, 175);
        }
        .select-item > span{
            position: absolute;
            width: 22px;
            height: 22px;
            right: 22px;
            top: 64px;
            display: none;
            z-index: 5;
            color: red;
        }
        .select-item > span > img{
            width: 100%;
            height: 100%;
        }
        span.color{
            color: red;
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thanh toán</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Trang chủ</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('process_checkout')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="print-error-msg" style="display:none">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Thông tin</h6>
                            <div class="checkout__input">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Họ Tên : </label>
                                        <input type="text" class="form-control" id="" value="{{$users->name}}" placeholder="" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Số Điện Thoại : </label>
                                        <input type="text" class="form-control" value="{{$users->phone}}" id="" placeholder=""  readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Địa Chỉ : </label>
                                    <input type="text" class="form-control" value="{{$users->address}}" id="" placeholder="" readonly>
                                </div>
                                <p>Ghi chú: <span>*</span></p>
                                <input type="text" name="note"  placeholder="Ghi chú về đơn đặt hàng...">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($products as $product)
                                        <li>{{$product->name}} <span>
                                             @if(!empty($product->promotion_price))
                                                    {{number_format(($product->original_price - $product->original_price * ($product->promotion_price/100)) * $product->quantity) }} đ
                                                @else
                                                    {{number_format($product->original_price * $product->quantity)}}đ
                                                @endif

                                            </span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tổng <span>{{number_format($total)}}đ</span></li>
                                </ul>
                                <button type="button" class="site-btn" id="btn-check-out">Thanh Toán</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <script src="../user/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    <script>
        const apiUrl = "https://sheltered-anchorage-60344.herokuapp.com";
        const apiEndpointDistrict = apiUrl + '/district/?idProvince=';
        const apiEndpointCommune = apiUrl + '/commune/?idDistrict=';

        async function getDistrict(idProvince) {
            const { data : districtList } = await axios.get(apiEndpointDistrict + idProvince);
            return districtList
        }

        async function getCommune(idDistrict){
            const { data : communeList } = await axios.get(apiEndpointCommune + idDistrict);
            return communeList
        }

        document.querySelector('#city-province').addEventListener("change", async () => {// get district and town when changing city/province
            document.querySelector('.district-town-select > span').style.display = "block";
            const idProvince = document.querySelector('#city-province').value;
            const districtList = await getDistrict(idProvince) || [];
            let outputDistrict = "<option value='0'>Chọn Quận/Huyện...</option>";
            let outputCommune = "<option value='0'>Chọn Phường/Xã...</option>";
            for (let i = 0; i < districtList.length; i ++){
                if (districtList[i].idProvince === idProvince){
                    outputDistrict += `<option value='${districtList[i].idDistrict}'>${districtList[i].name}</option>`;
                }
            }
            document.querySelector('#district-town').innerHTML = outputDistrict;
            document.querySelector('#ward-commune').innerHTML = outputCommune;
            document.querySelector('.district-town-select > span').style.display = "none";
        })

        document.querySelector('#district-town').addEventListener("change", async () => {// get ward and commune when changing district/town
            document.querySelector('.ward-commune-select> span').style.display = "block";
            const idDistrict = document.querySelector('#district-town').value;
            const communeList = await getCommune(idDistrict) || [];
            let outputCommune = "<option value='0'>Chọn Phường/Xã...</option>";
            for (let i = 0; i < communeList.length; i ++){
                if (communeList[i].idDistrict === idDistrict){
                    outputCommune += `<option value='${communeList[i].idCommune}'>${communeList[i].name}</option>`;
                }
            }
            document.querySelector('#ward-commune').innerHTML = outputCommune;
            document.querySelector('.ward-commune-select > span').style.display = "none";

        })

        document.querySelector('#ward-commune').addEventListener("change", async () => {
            document.getElementById("diachi").innerHTML = '<input type="hidden" id="address" value="'+$( "#ward-commune option:selected" ).text() + ' - ' + $( "#district-town option:selected" ).text() + ' - ' + $( "#city-province option:selected" ).text()+'" name="address"  >';
        })
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btn-check-out', function (e) {
                e.preventDefault();
                var note = $('input[name="note"]').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('process_checkout')}}',
                    type: 'POST',
                    data:{
                        'note' : note,
                    },
                    success: function (data) {
                        if(data.success === 200){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Cảm ơn quý khách rất nhiều!',
                                icon: 'success',
                                confirmButtonText: "Oke",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/';
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
                                    window.location.href = '/';
                                }
                            });
                        }  else{
                            printErrorMsg(data.error);
                        }
                    }
                })

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
