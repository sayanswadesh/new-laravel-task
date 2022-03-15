@extends('Backend.Layouts.app')
@section('stylesheet')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{url('assets/plugins/jqvmap/jqvmap.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{url('assets/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{url('assets/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="filter_year" id="filter_year" class="select_year  form-control">
                        @php
                        $y = (int)date('Y');
                        $listY = date("Y", strtotime("-5 year"));
                        @endphp
                        <option value="{{$y}}" selected="true">{{$y}}</option>
                        <?php
                        $y--;
                        for ($y; $y > $listY; $y--) {
                        ?>
                            <option value="{{$y}}">{{$y}}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="filter_month" id="filter_month" class="select_month form-control">
                        <?php
                        for ($m = 0; $m <= 12; ++$m) {
                            $time = strtotime(sprintf('+%d months', $m));
                            $Monthdecimalvalue = date('m', $time);
                            $MonthName = date('F', $time);
                            printf('<option value="%s">%s</option>', $Monthdecimalvalue, $MonthName);
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="dashboard_contant">
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- ChartJS -->
<script src="{{url('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script>
<script>
    /* On Change Financial Year */
    $('select[name="filter_year"],select[name="filter_month"]').on('change', function() {
        var filter_year = $('select[name="filter_year"]').val();
        var filter_month = $('select[name="filter_month"]').val();
        $.ajax({
            url: "{{route('getDashboard')}}",
            type: "get",
            data: {
                filter_year: filter_year,
                filter_month: filter_month
            },
            success: function(res) {
                $('#dashboard_contant').html(res);
            }
        });
    });
    $('select[name="filter_month"]').trigger('change');
</script>
@endsection