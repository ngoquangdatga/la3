@extends('users')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        .select-item{
            width: 100%;
            font-family: 'Montserrat', sans-serif;
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

            border-radius: 3px;
            outline: none;
            background: none;
            box-shadow: none;
            border: 1px solid rgb(175, 175, 175);
        }
        .select-item > span{
            position: absolute;
            width: 22px;
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
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img src="../user/img/login.jpg" class="img-fluid" style="min-height:100%;" />
            </div>
            <div class="col-md-6 bg-white p-5">
                <h3 class="pb-3">Đăng ký</h3>
                <div class="form-style">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form action="{{route('signin')}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group pb-3">
                            <label for="ward-commune">
                                <p> Họ tên :<span class="color">*</span></p>
                            </label>
                            <input type="text" name="name" placeholder="Họ Tên" class="form-control" id="" aria-describedby="">
                            <div class="alert-message" id="nameError"></div>
                        </div>
                        <div class="form-group pb-3">
                            <label for="ward-commune">
                                <p> Số điện thoại :<span class="color">*</span></p>
                            </label>
                            <input type="text" name="phone" placeholder="Số điện thoại" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group pb-3">
                            <label for="ward-commune">
                                <p> Email :<span class="color">*</span></p>
                            </label>
                            <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group pb-3">
                            <label for="ward-commune">
                                <p> Mật khẩu :<span class="color">*</span></p>
                            </label>
                            <input type="password" name="password" placeholder="Mật khẩu" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="rs1-select2 rs2-select2  bg0 m-b-12 m-t-9">
                                    <div class="select-item">
                                        <label for="city-province">
                                            <p>Tỉnh/Thành Phố : <span class="color">*</span></p>
                                        </label>
                                        <select id="city-province" name="tinh" class="input">
                                            <option value='0'>&nbsp;Chọn Tỉnh/Thành Phố...</option>
                                            <option value='01'>Thành phố Hà Nội</option>
                                            <option value='79'>Thành phố Hồ Chí Minh</option>
                                            <option value='31'>Thành phố Hải Phòng</option>
                                            <option value='48'>Thành phố Đà Nẵng</option>
                                            <option value='92'>Thành phố Cần Thơ</option>
                                            <option value='02'>Tỉnh Hà Giang</option>
                                            <option value='04'>Tỉnh Cao Bằng</option>
                                            <option value='06'>Tỉnh Bắc Kạn</option>
                                            <option value='08'>Tỉnh Tuyên Quang</option>
                                            <option value='10'>Tỉnh Lào Cai</option>
                                            <option value='11'>Tỉnh Điện Biên</option>
                                            <option value='12'>Tỉnh Lai Châu</option>
                                            <option value='14'>Tỉnh Sơn La</option>
                                            <option value='15'>Tỉnh Yên Bái</option>
                                            <option value='17'>Tỉnh Hoà Bình</option>
                                            <option value='19'>Tỉnh Thái Nguyên</option>
                                            <option value='20'>Tỉnh Lạng Sơn</option>
                                            <option value='22'>Tỉnh Quảng Ninh</option>
                                            <option value='24'>Tỉnh Bắc Giang</option>
                                            <option value='25'>Tỉnh Phú Thọ</option>
                                            <option value='26'>Tỉnh Vĩnh Phúc</option>
                                            <option value='27'>Tỉnh Bắc Ninh</option>
                                            <option value='30'>Tỉnh Hải Dương</option>
                                            <option value='33'>Tỉnh Hưng Yên</option>
                                            <option value='34'>Tỉnh Thái Bình</option>
                                            <option value='35'>Tỉnh Hà Nam</option>
                                            <option value='36'>Tỉnh Nam Định</option>
                                            <option value='37'>Tỉnh Ninh Bình</option>
                                            <option value='38'>Tỉnh Thanh Hóa</option>
                                            <option value='40'>Tỉnh Nghệ An</option>
                                            <option value='42'>Tỉnh Hà Tĩnh</option>
                                            <option value='44'>Tỉnh Quảng Bình</option>
                                            <option value='45'>Tỉnh Quảng Trị</option>
                                            <option value='46'>Tỉnh Thừa Thiên Huế</option>
                                            <option value='49'>Tỉnh Quảng Nam</option>
                                            <option value='51'>Tỉnh Quảng Ngãi</option>
                                            <option value='52'>Tỉnh Bình Định</option>
                                            <option value='54'>Tỉnh Phú Yên</option>
                                            <option value='56'>Tỉnh Khánh Hòa</option>
                                            <option value='58'>Tỉnh Ninh Thuận</option>
                                            <option value='60'>Tỉnh Bình Thuận</option>
                                            <option value='62'>Tỉnh Kon Tum</option>
                                            <option value='64'>Tỉnh Gia Lai</option>
                                            <option value='66'>Tỉnh Đắk Lắk</option>
                                            <option value='67'>Tỉnh Đắk Nông</option>
                                            <option value='68'>Tỉnh Lâm Đồng</option>
                                            <option value='70'>Tỉnh Bình Phước</option>
                                            <option value='72'>Tỉnh Tây Ninh</option>
                                            <option value='74'>Tỉnh Bình Dương</option>
                                            <option value='75'>Tỉnh Đồng Nai</option>
                                            <option value='77'>Tỉnh Bà Rịa - Vũng Tàu</option>
                                            <option value='80'>Tỉnh Long An</option>
                                            <option value='82'>Tỉnh Tiền Giang</option>
                                            <option value='83'>Tỉnh Bến Tre</option>
                                            <option value='84'>Tỉnh Trà Vinh</option>
                                            <option value='86'>Tỉnh Vĩnh Long</option>
                                            <option value='87'>Tỉnh Đồng Tháp</option>
                                            <option value='89'>Tỉnh An Giang</option>
                                            <option value='91'>Tỉnh Kiên Giang</option>
                                            <option value='93'>Tỉnh Hậu Giang</option>
                                            <option value='94'>Tỉnh Sóc Trăng</option>
                                            <option value='95'>Tỉnh Bạc Liêu</option>
                                            <option value='96'>Tỉnh Cà Mau</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class=" bg0 m-b-12">
                                    <div class="select-item district-town-select">
                                        <label for="district-town">
                                            <p>Quận/Huyện :<span class="color">*</span></p>
                                        </label>
                                        <select id="district-town" name="huyen">
                                            <option value='0'>&nbsp;Chọn Quận/Huyện...</option>
                                        </select>
                                        <span>
                                                <img src="https://firebasestorage.googleapis.com/v0/b/qtv-music-shop.appspot.com/o/loading-icon%2Floading-icon-small.gif?alt=media&token=769f1086-0302-4e17-852e-e1409ec215b4" alt="loading-icon">
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class=" bg0 m-b-22">
                                    <div class="select-item ward-commune-select">
                                        <label for="ward-commune">
                                            <p> Xã/Phường :<span class="color">*</span></p>
                                        </label>
                                        <select id="ward-commune" name="xa">
                                            <option value='0'>&nbsp;Chọn Phường/Xã...</option>
                                        </select>
                                        <span><img src="https://firebasestorage.googleapis.com/v0/b/qtv-music-shop.appspot.com/o/loading-icon%2Floading-icon-small.gif?alt=media&token=769f1086-0302-4e17-852e-e1409ec215b4" alt="loading-icon"></span>
                                    </div>
                                </div>
                                <div id="diachi">
                                </div>
                            </div>
                        </div>
                        <div class="pb-2">
                            <button type="button" id="btn-sign-in" class="btn btn-dark w-100 font-weight-bold mt-2">Đăng ký</button>
                        </div>
                    </form>
                    <div class="sideline">hoặc</div>
                    <div>
                        <a href="{{ url('google') }}" class="btn btn-danger w-100 font-weight-bold mt-2"><i class="fa fa-google-plus" aria-hidden="true"></i> Đăng nhập bằng Google</a>
                    </div>
                    <div class="pt-4 text-center">
                        Bạn đã có tài khoản <a href="/login">Đăng nhập</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
        $(document).ready(function(){
            $(document).on('click', '#btn-sign-in', function(e){
                var name        = $('input[name="name"]').val();
                var phone       = $('input[name="phone"]').val();
                var email       = $('input[name="email"]').val();
                var password    = $('input[name="password"]').val();
                var city        = $('#city-province').val();
                var district    = $('#district-town').val();
                var ward        = $('#ward-commune').val();
                var address     = $('#address').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{route('signin')}}',
                    type: 'POST',
                    data:{
                        'name'      : name,
                        'phone'     : phone,
                        'email'     : email,
                        'password'  : password,
                        'city'      : city,
                        'district'  : district,
                        'ward'      : ward,
                        'address'   : address,
                    },
                    success: function (data) {
                        if($.isEmptyObject(data.error)){
                            Swal.fire({
                                title: 'Thành Công!',
                                text: 'Đăng ký đã thành công!',
                                icon: 'success',
                                confirmButtonText: "Đăng nhập",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed){
                                    window.location.href = '/login';
                                }
                            });

                        }else{
                            printErrorMsg(data.error);
                        }
                    }, error: function (request, status, error) {
                        var err = "Email đã tồn tại vui lòng sử dụng email khác!";
                        //alert(err.message);
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display','block');
                        $(".print-error-msg").find("ul").append('<div class="alert alert-danger" role="alert">'+err+'</div>');
                    }
                })

            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        });
    </script>
@endsection
