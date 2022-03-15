@extends('Backend.Layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                @if(Auth::user()->image!='')
                                <img src="{{url(Auth::user()->image)}}" class="profile-user-img img-fluid img-circle" id="item-img-output" alt="User profile picture" style="width: 150px; height: 150px;" />
                                @else
                                <img src="{{url('assets/dist/img/AdminLTELogo.png')}}" class="profile-user-img img-fluid img-circle" id="item-img-output" alt="User profile picture" />
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                            <p class="text-muted text-center">{{Auth::user()->role}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <i class="fa fa-envelope"></i> <b>{{Auth::user()->email}}</b>
                                </li>

                                @if(!empty(Auth::user()->phone))
                                <li class="list-group-item">
                                    <i class="fa fa-phone-square"></i> <b>{{Auth::user()->phone}}</b>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                @yield('profileContent')
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
@endsection