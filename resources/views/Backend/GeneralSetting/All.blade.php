@extends('Backend.Layouts.app')
@section('stylesheet')
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (count($errors) > 0)
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">App Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form id="generalsetting_form" class="form-horizontal dashed-row" action="{{route('saveGeneralSetting',['id'=>$ID])}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="card-body">
                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">Site logo</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img src="{{asset($data->site_logo)}}" width="80">
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="file" name="site_logo" class="form-control-file" accept="image/*">
                                                    <small>best size 251 x 77px</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">Site Icon</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img src="{{asset($data->site_icon)}}" width="80">
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="file" name="site_icon" class="form-control-file" accept="image/*">
                                                    <small>best size 251 x 77px</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">Signin page background image</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <img src="{{asset($data->signIn_backgroundImage)}}" width="80">
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="file" name="signIn_backgroundImage" class="form-control-file" accept="image/*">
                                                    <small>best size 1920 x 1080px</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">App Title<span class="requiredAsterisk">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="app_title" class="form-control" value="{{$data->app_title}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection


@section('script')
<script>
    $(document).ready(function() {
        jQuery("#generalsetting_form").validate({
            rules: {
                app_title: {
                    required: true
                }
            },
            messages: {
                app_title: {
                    required: "This field is required."
                }
            }
        });
    });
</script>
@endsection