@php
$general_setting = App\Helper\SiteSettingHelper::general_setting();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$general_setting['app_title']}}</title>
    <link rel="icon" type="image/png" href="{{asset($general_setting['site_icon'])}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset($general_setting['site_icon'])}}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{url('assets/plugins/toastr/toastr.min.css')}}">
    @yield('stylesheet')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <script type="text/javascript">
        var settings = {
            logOutURL: "{{route('dev_logout')}}",
            LoaderGif: "{{url('assets/img/loader.gif')}}"
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check())
                        <img src="{{url(Auth::user()->image)}}" class="user-image img-circle elevation-2 alt=" user="" image="">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            @if(Auth::check())
                            <img src="{{url(Auth::user()->image)}}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{Auth::user()->name}}
                            </p>
                            @endif
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="float-left">
                                <a href="{{route('generalDevProfile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-default btn-flat" href="{{route('dev_logout')}}">
                                    Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Developer.Layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020-{{date('Y')}} <a href="#">{{$general_setting['app_title']}}</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            </div>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Model Start -->
    <div class="modal fade" id="AjaxModel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="AjaxModelTitle">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                </div>
                <div id="AjaxModelContent">
                </div>
            </div>
        </div>
    </div>
    <!-- Model End -->
    <!-- jQuery -->
    <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{url('assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Custom -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <script>
        $(document).on('select2:open', (e) => {
            const selectId = e.target.id
            $(".select2-search__field[aria-controls='select2-" + selectId + "-results']").each(function(
                key,
                value,
            ) {
                value.focus()
            })
        })
    </script>
    <script>
        @if(Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}");
        @endif
        @if(Session::has('info'))
        toastr["info"]("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
        toastr["warning"]("{{ Session::get('warning') }}");
        @endif
        @if(Session::has('error'))
        toastr["error"]("{{ Session::get('error') }}");
        @endif
    </script>
    @yield('script')
</body>

</html>