<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi Tiết Hóa Đơn</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/user/css/print.css">
</head>
<body>
<div class="container">
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="row">
                <div class="text-left col-sm-6">
                    <a href="{{route('admin/bill')}}" class="btn btn-success">Quay lại</a>
                </div>
                <div class="text-right col-sm-6">
                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Xuất hóa đơn</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-file-pdf-o"></i>Cập nhật đơn hàng</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto" id="exportContent">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="">
                                <img src="../../user/img/logo.png" data-holder-rendered="true" />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="">
                                    Shop Thời Trang
                                </a>
                            </h2>
                            <div>Hải An, Hải Lăng, Quảng Trị</div>
                            <div>(+84) 34 7184 502</div>
                            <div>khaitkdev@gmail.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">Gửi đến:</div>
                            <h5 class="to">{{$customers->name}}</h5>
                            <div class="phone">{{$customers->phone}}</div>
                            <div class="address">{{$customers->address}}</div>
                            <div class="email">{{$customers->email}}</div>
                        </div>
                        <div class="col invoice-details">
                            <div class="date">Ngày : {{ date('Y-m-d H:i:s') }}</div>
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
                                <td class="text-left"><h3>{{$bill->name_product}}</h3>Kích thước : {{$bill->size}} - Màu : {{$bill->color}}</td>
                                <td class="unit">{{number_format($bill->original_price)}} đ</td>
                                <td class="qty">{{$bill->quantity}}</td>
                                <td class="total">{{number_format($bill->original_price * $bill->quantity)}} đ</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tổng Cộng</td>
                            <td>{{number_format($customers->total)}} đ</td>
                        </tr>
                        </tfoot>
                    </table>
                    <br>
                    <div class="thanks"></div>
                    <div class="notices">
                        <div>Lưu ý:</div>
                        <div class="notice">Khách hành được đổi trả sản phẩm sau 7 ngày.</div>
                    </div>
                </main>
                <footer>
                    Cảm ơn quý khách đã mua hàng tại Shop Thời Trang
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
        @php
            $id = request('id');
        @endphp
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật trạng thái đơn hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin/update_bill', $id)}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Trạng thái</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="status">
                                    <option>Đang xử lý</option>
                                    <option value="Đang vận chuyển">Đang vận chuyển</option>
                                    <option value="Đã giao hàng">Đã giao hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    $('#printInvoice').click(function(){
        var divContents = $("#exportContent").html();
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>DIV Contents</title>');
        printWindow.document.write('<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">');
        printWindow.document.write(' <link rel="stylesheet" href="../css/print.css">');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });

</script>
</body>
</html>
