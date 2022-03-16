@extends('Developer.Profile.header')

@section('profileContent')
<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            @include('Developer.Profile.tab')
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <form id="profile_form" class="form-horizontal dashed-row white-field" action="{{route('saveDevGeneralProfile')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">First Name<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="first_name" class="form-control" id="inputName" placeholder="Enter first  name" value="{{Auth::user()->first_name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Last Name<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="last_name" class="form-control" id="inputName" placeholder="Enter last  name" value="{{Auth::user()->last_name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Enter email" value="{{Auth::user()->email}}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputMobile" class="col-sm-2 col-form-label">Mobile<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="mobile" class="form-control" id="inputMobile" placeholder="Enter mobile" value="{{Auth::user()->mobile}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label">Image<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="file" id="file" placeholder="Select File." />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <img id="image_preview_container" src="{{url(Auth::user()->image)}}" alt="preview image" style="max-height: 150px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>



@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#file').change(function() {
            var fileName = $('#file').val();
            var str = fileName.replace(/^.*\./, '');
            var ext = str.toLowerCase();
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview_container').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

            } else {
                toastr["error"]("Only accepted jpg,jpeg,png");
            }
        });
        /* Profile Validation */
        $("#profile_form").validate({

            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "Name is required."
                },
                last_name: {
                    required: "Name is required."
                },
                email: {
                    required: "Email is required.",
                    email: "Enter valid email"
                },
                mobile: {
                    required: "Mobile is required."
                }
            }
        });
    });
</script>
@endsection