@extends('Backend.Profile.header')

@section('profileContent')
<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            @include('Backend.Profile.tab')
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <form id="profile_account_form" class="form-horizontal dashed-row" action="{{route('saveAccountSettingProfile')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="inputOldPas" class="col-sm-2 col-form-label">Old Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="old_password" class="form-control" id="inputOldPas" value="" placeholder="Enter old password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputNewPass" class="col-sm-2 col-form-label">New Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="new_password" class="form-control" id="inputNewPass"  id="Password" value="" placeholder="Enter new password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputConPass" class="col-sm-2 col-form-label">Confirm Password<span class="requiredAsterisk">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" name="confirm_password" class="form-control" id="inputConPass" value="" placeholder="Re-enter new password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Save</button>
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

        jQuery("#profile_account_form").validate({

            rules: {
                old_password: {
                    required: true
                },
                new_password: {
                    required: true
                },
                confirm_password: {
                    required: true,
                    equalTo: '#Password'
                }
            },
            messages: {
                old_password: {
                    required: "This field is required."
                },
                new_password: {
                    required: "This field is required."
                },
                confirm_password: {
                    required: "Mobile is required.",
                    equalTo: "Password does not match."
                }
            }

        });

    });
</script>
@endsection