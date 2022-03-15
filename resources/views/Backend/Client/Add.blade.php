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
                            <h3 class="card-title">Add Client</h3>
                            <a href="{{route('allClients')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="add_form" action="{{route('saveClient')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client_name">Client Name<span class="requiredAsterisk">*</span></label>
                                            <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter client name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile<span class="requiredAsterisk">*</span></label>
                                            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email<span class="requiredAsterisk">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary ">Save</button>
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
    $(document).ready(function(e) {
        $("#add_form").validate({
            rules: {
                client_name: {
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
            },
            messages: {
                client_name: {
                    required: "This field is required"
                },
                mobile: {
                    required: "This field is required"
                },
                email: {
                    required: "This field is required"
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