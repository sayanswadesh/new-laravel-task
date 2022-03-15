@php
$general_setting = App\Helper\SiteSettingHelper::general_setting();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$general_setting['app_title']}}-Forgot Password</title>
    <link rel="icon" type="image/png" href="{{asset($general_setting['site_icon'])}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset($general_setting['site_icon'])}}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page"style="background: url('{{asset($general_setting->signIn_backgroundImage)}}'); background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{route('admin_login')}}">
                <img src="{{asset($general_setting['site_logo'])}}" style="max-width: 100%;max-height: 100px;">
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <!-- <div class="card-header text-center">
                <a href="{{route('admin_login')}}" class="h1"><b>{{$general_setting['app_title']}}</b></a>
            </div> -->
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('info'))
                <div class="alert alert-info">{{ Session::get('info') }}</div>
                @endif
                @if (Session::has('warning'))
                <div class="alert alert-warning">{{ Session::get('warning') }}</div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                <form id="password_form" method="post" action="{{route('saveForgotPassword')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="input-group mb-3 form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p class="mb-1">
                                <a href="{{route('admin_login')}}"><i class="fa fa-arrow-left"></i> Back to login</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sent</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- jquery-validation -->
    <script src="{{url('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('assets/dist/js/adminlte.min.js')}}"></script>


    <script>
        $(document).ready(function() {

            jQuery("#password_form").validate({

                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required.",
                        email: "Enter a valid email address."
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }

            });

        });
    </script>
</body>

</html>