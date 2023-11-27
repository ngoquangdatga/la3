@extends('admin')
@section('title', 'Thống kê')
@section('content')
    <style>

        .graph {
            margin-bottom: 1em;
            font: normal 100%/150% arial, helvetica, sans-serif;
        }

        .graph caption {
            font: bold 150%/120% arial, helvetica, sans-serif;
            padding-bottom: 0.33em;
        }

        .graph tbody th {
            text-align: right;
        }

        @supports (display:grid) {

            @media (min-width: 32em) {

                .graph {
                    display: block;
                    width: 500px;
                    height: 300px;
                }

                .graph caption {
                    display: block;
                }

                .graph thead {
                    display: none;
                }

                .graph tbody {
                    position: relative;
                    display: grid;
                    grid-template-columns:repeat(auto-fit, minmax(2em, 1fr));
                    column-gap: 2.5%;
                    align-items: end;
                    height: 100%;
                    margin: 3em 0 1em 2.8em;
                    padding: 0 1em;
                    border-bottom: 2px solid rgba(0, 0, 0, 0.5);
                    background: repeating-linear-gradient(
                        180deg,
                        rgba(170, 170, 170, 0.7) 0,
                        rgba(170, 170, 170, 0.7) 1px,
                        transparent 1px,
                        transparent 20%
                    );
                }

                .graph tbody:before,
                .graph tbody:after {
                    position: absolute;
                    left: -3.2em;
                    width: 2.8em;
                    text-align: right;
                    font: bold 80%/120% arial, helvetica, sans-serif;
                }

                .graph tbody:before {
                    content: "100%";
                    top: -0.6em;
                }

                .graph tbody:after {
                    content: "0%";
                    bottom: -0.6em;
                }

                .graph tr {
                    position: relative;
                    display: block;
                }

                .graph tr:hover {
                    z-index: 999;
                }

                .graph th,
                .graph td {
                    display: block;
                    text-align: center;
                }

                .graph tbody th {
                    position: absolute;
                    width: 100%;
                    bottom: 100px;
                    font-weight: normal;
                    text-align: center;
                    white-space: nowrap;
                    text-indent: 0;
                    transform: rotate(270deg);
                }

                .graph tbody th:after {
                    content: "";
                }

                .graph td {
                    width: 100%;
                    height: 100%;
                    background: #F63;
                    border-radius: 0.5em 0.5em 0 0;
                    transition: background 0.5s;
                }

                .graph tr:hover td {
                    opacity: 0.7;
                }

                .graph td span {
                    overflow: hidden;
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    width: 0;
                    padding: 0.5em 0;
                    margin: -1em 0 0;
                    font: normal 85%/120% arial, helvetica, sans-serif;
                    font-weight: bold;
                    opacity: 0;
                    transition: opacity 0.5s;
                    color: white;
                }

                .toggleGraph:checked + table td span,
                .graph tr:hover td span {
                    width: 4em;
                    margin-left: -2em; /* 1/2 the declared width */
                    opacity: 1;
                }


            } /* min-width:32em */

        }

        /* grid only */
    </style>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thống Kê</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Trang Chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thống Kê</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thống Kê</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <form action="{{route('admin/statistic')}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <div class="form-group" id="simple-date1">
                                        <label for="simpleDataInput">Bắt Đầu</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="start_date" placeholder=""  value="<?php  if(isset($_POST['start_date'])){ echo $_POST['start_date']; }  ?>" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group" id="simple-date2">
                                        <label for="oneYearView">Kết Thúc</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="end_date" placeholder="" value="<?php  if(isset($_POST['end_date'])){ echo $_POST['end_date']; }  ?>" id="oneYearView">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label for="oneYearView"><br></label>
                                        <div class="input-group date">
                                            <button type="submit" class="btn btn-primary ">Tìm Kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </form>
                        @if($bills->count() > 0)
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-success" id="btnExport" value="Export" onclick="Export()"><i class="fa fa-download" aria-hidden="true"></i> Xuất
                                </button>
                            </div>

                            <br>
                            <table class="table align-items-center table-flush table-hover text-center" id="tblCustomers">
                                <thead class="thead-light">
                                <tr>
                                    <th>Khách Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Ngày Thanh Toán</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                    <tr>
                                        <td>
                                            {{$bill->name}}
                                        </td>
                                        <td>{{number_format($bill->total)}} đ</td>
                                        <td>{{$bill->created_at->format('d/m/Y')}}</td>
                                    </tr>
                                @endforeach
                                <tr class="bg-success">
                                    <td colspan="1"><b class="text-white">Tổng Cộng : </b></td>
                                    <td colspan="2"><b class="text-white">{{number_format($total)}} đ</b></td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Dữ liệu tìm không thấy
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
            <!--Row-->
            @if($bills->count() > 0)
                <div class="col-lg-7 col-sm-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Biểu đồ thống kê</h6>
                        </div>
                        <div class="card-body">
                            <table class="graph">
                                <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Percent</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($count_category_product as $item)
                                    <tr style="height:{{round(($item->total/$count_total_product)*100)}}%">
                                        <th scope="row"><b>{{$item->name}}</b></th>
                                        <td><span>{{round(($item->total/$count_total_product)*100)}}%</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <!--Row-->
            @if($bills->count() > 0)
                <div class="col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tổng</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th></th>
                                    <th>Tổng</th>
                                </tr>
                                <tr>
                                    <td>Số Lượng Sản Phẩm Bán Ra : </td>
                                    <td><b>{{$total_product}}</b></td>
                                </tr>
                                <tr>
                                    <td>Số Lượng Người Mua Hàng : </td>
                                    <td><b>{{$total_user}}</b></td>
                                </tr>
                                <tr>
                                    <td>Tổng Tiền Tất Cả : </td>
                                    <td><b>{{number_format($total_all)}}đ</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <!--Row-->
        </div>
        <!---Container Fluid-->

@endsection
