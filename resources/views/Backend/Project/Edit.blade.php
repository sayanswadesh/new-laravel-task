@extends('Backend.Layouts.app')
@section('stylesheet')
<!-- Select2 -->
<link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                            <h3 class="card-title">Update Project</h3>
                            <a href="{{route('allProject')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form id="add_form" action="{{route('updateMenuItem')}}" class="form-horizontal" autocomplete="off" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="project_name">Project Name<span class="requiredAsterisk">*</span></label>
                                            <input type="text" name="project_name" value="{{$records['project_name']}}" class="form-control" placeholder="Enter Project Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Duration<span class="requiredAsterisk">*</span></label>
                                            <input type="number" name="duration" value="{{$records['duration']}}" class="form-control" placeholder="Enter duration">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="developer_id">Developer</label>
                                            <select class="form-control select2" style="width: 100%;" id="developer_id" name="developer_id" data-placeholder="Select Client">
                                                @foreach($all_developers as $row_developer)
                                                <option value="{{$row_developer['id']}}" @if($records['developer_id']==$row_developer['id']){{'selected'}} @endif>{{$row_developer['first_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client_id">Client</label>
                                            <select class="form-control select2" style="width: 100%;" id="client_id" name="client_id" data-placeholder="Select Client">
                                                @foreach($all_clients as $row_client)
                                                <option value="{{$row_client['id']}}" @if($records['client_id']==$row_client['id']){{'selected'}} @endif>{{$row_client['client_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <input type="hidden" name="hidden_id" value="{{$records['id']}}">
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
@endsection
@section('script')
<!-- jquery-validation -->
<script src="{{url('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{url('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Custom -->
<script src="{{url('assets/js/script.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        //Initialize Select2 Elements
        $('.select2').select2()
        /* Validate Form */
        $("#add_form").validate({
            rules: {
                project_name: {
                    required: true
                },
                duration: {
                    required: true
                },
                developer_id: {
                    required: true
                },
                client_id: {
                    required: true
                }
            },
            messages: {
                project_name: {
                    required: "This field is required",
                },
                duration: {
                    required: "This field is required",
                },
                developer_id: {
                    required: "This field is required",
                },
                client_id: {
                    required: "This field is required",
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