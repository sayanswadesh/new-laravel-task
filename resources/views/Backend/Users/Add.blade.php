@extends('Backend.Layouts.app')
@section('stylesheet')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    <!-- general form elements -->
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">Add User</h3>
                            <a href="{{route('allUsers')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="user_form" action="{{route('saveUser')}}" class="form-horizontal" method="post" autocomplete="off">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="login_id">LogIn Id<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="login_id" class="form-control" placeholder="Log In Id">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password<span class="requiredAsterisk">*</span></label>
                                            <label><span onclick="pass_gen()" data-toggle="modal" data-target="#password_generate" class="btn btn-success  badge badge-pill badge-success">Generate password</span></label>
                                            <input type="password" name="password" class="form-control" id="Password" value="" autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="confirm_password">Confirm Password<span class="requiredAsterisk">*</span></label>
                                            <input type="password" name="confirm_password" class="form-control" value="" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-check-circle"></span> Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div id="password_generate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Password Generator</h5>
                <button type="button" class="close" id="close">&times;</button>
            </div>
            <div class="modal-body">
                <input class="form-control gen_password_field" readonly type="text" id="copyTarget" value="Text to Copy">
            </div>
            <div class="modal-footer text-center">
                <button type="button" id="regenerate_password" class="btn btn-warning" onClick="reg_pass()">Re-Generate</button>
                <button type="button" id="copyButton" class="btn btn-success">Copy & Paste</button>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<!-- jquery-validation -->
<script src="{{url('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{url('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">

    function pass_gen() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < 8; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        $('#copyTarget').val(text);
        // $('#password_generate').modal('show');
    }

    function reg_pass() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 8; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        $('#copyTarget').val(text);
    }

    function copyToClipboard(elem) {
        // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch (e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }
    $('#copyButton').click(function() {
        //alert('1');
        var new_password = $('#copyTarget').val();
        //alert(new_password);
        $('input[name=password]').val(new_password);
        $('input[name=confirm_password]').val(new_password);
    });
    document.getElementById("copyButton").addEventListener("click", function() {
        copyToClipboard(document.getElementById("copyTarget"));
        setTimeout(function() {
            $("#close").click();
        }, 1);
    });
    $('#close').click(function() {
        $('#password_generate').modal('hide');
    });
    /* On Change Role */
    $(document).ready(function() {
        jQuery("#user_form").validate({

            rules: {
                name: {
                    required: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    maxlength: 11,
                    minlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                login_id: {
                    required: true
                },
                password: {
                    required: true
                },
                confirm_password: {
                    required: true,
                    equalTo: '#Password'
                }

            },
            messages: {
                name: {
                    required: "This field is required",
                },
                mobile: {
                    required: "This field is required",
                    digits: "Enter a valid mobile number.",
                    maxlength: "Enter a valid mobile number.",
                    minlength: "Enter a valid mobile number."
                },
                email: {
                    required: "This field is required",
                    email: "Enter a valid email address."
                },
                login_id: {
                    required: "This field is required",
                },
                password: {
                    required: "This field is required",
                },
                confirm_password: {
                    required: "This field is required",
                    equalTo: "Password does not match."
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
@endsection