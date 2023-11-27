<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../admin/img/logo/logo.png" rel="icon">
    <title> @yield('title')</title>
    <base href="{{asset('')}}">
    <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../admin/css/ruang-admin.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="../admin/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Touchspin -->
    <link href="../admin/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet" >
    <link href="../admin/vendor/datatables/datatable.bootstrap4.min.css" rel="stylesheet">
    <link href="../admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="..admin/vendor/clock-picker/clockpicker.css" rel="stylesheet">
{{--    sweetalert2--}}
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .dot {
            height: 25px;
            width: 25px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    @include('admin.nav')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </nav>
            <!-- Topbar -->
            @yield('content')
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Developed By
                      <b><a href="https://khaitk.blogspot.com/" target="_blank">Khai</a></b>
                    </span>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="../admin/vendor/jquery/jquery.min.js"></script>
<script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Select2 -->
<script src="../admin/vendor/select2/dist/js/select2.min.js"></script>
<!-- Bootstrap Touchspin -->
<script src="../admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="../admin/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
<!-- Page level plugins -->
<script src="../admin/vendor/datatables/jquery.datatable.min.js"></script>
<script src="../admin/vendor/datatables/datatable.bootstrap4.min.js"></script>

<script src="..admin/vendor/clock-picker/clockpicker.js"></script>

<script src="../admin/js/ruang-admin.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- Sweetalert2 - Alert box -->
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<script src="../admin/vendor/chart.js/Chart.min.js"></script>

<script src="../admin/js/demo/chart-area-demo.js"></script>
<script src="../admin/js/demo/chart-pie-demo.js"></script>
<script src="../admin/js/demo/chart-bar-demo.js"></script>
<script type="text/javascript">
    function Export() {
        let ms = new Date().toISOString().split('T')[0];;
        $("#tblCustomers").table2excel({
            filename: "ThongKe_"+ms+".xls"
        });
    }
</script>
<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>

<script>
    $(document).ready(function () {

        $('#simple-date1 .input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });

        $('#simple-date2 .input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });


        $('.compose-textarea').summernote({
            placeholder: 'Nhập mô tả',
            tabsize: 2,
            height: 320,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.select2-single').select2();

        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
            placeholder: "Select a Province",
            allowClear: true
        });

        // Select2 Multiple
        $('.select2-multiple').select2();

        // TouchSpin

        $('#touchSpin1').TouchSpin({
            min: 0,
            max: 100,
            boostat: 5,
            maxboostedstep: 10,
            initval: 0
        });

        $('#touchSpin2').TouchSpin({
            min:0,
            max: 100,
            decimals: 2,
            step: 0.1,
            postfix: '%',
            initval: 0,
            boostat: 5,
            maxboostedstep: 10
        });

        $('#touchSpin3').TouchSpin({
            min: 0,
            max: 100,
            initval: 0,
            boostat: 5,
            maxboostedstep: 10,
            verticalbuttons: true,
        });


        $('#check-minutes').click(function(e){
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });

        $('#start_calendar').click(function(e){

        });

    });
</script>
</body>

</html>
