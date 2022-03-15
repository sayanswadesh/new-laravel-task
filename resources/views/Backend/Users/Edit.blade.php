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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                            <a href="{{route('allUsers')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <form id="user_form" action="{{route('updateUser',['id'=>$ID])}}" class="form-horizontal" method="post">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="name" class="form-control" value="{{$records->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Mobile<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="mobile" class="form-control" value="{{$records->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Email<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="email" class="form-control" value="{{$records->email}}" readonly>
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
@endsection
@section('script')
<!-- jquery-validation -->
<script src="{{url('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{url('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery("#user_form").validate({
            rules: {
                name: {
                    required: true
                },
                mobile: {
                    required: true,
                    digits: true,
                },
                email: {
                    required: true,
                    email: true
                }

            },
            messages: {

                name: {
                    required: "Name is required."
                },
                mobile: {
                    required: "Mobile is required.",
                    digits: "Enter a valid mobile number.",
                },
                email: {
                    required: "Email is required.",
                    email: "Enter a valid email address."
                }

            }

        });

    });
</script>
@endsection