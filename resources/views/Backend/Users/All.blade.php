@extends('Backend.Layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All User's</h3>
                            <a href="{{route('addUser')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-circle"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
                                        <th style="width: 80px; text-align: center;"><i class="fa fa-bars"></i> </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
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
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        "columnDefs": [{
            "className": "dt-center",
            "targets": "_all"
        }],
        order: [],
        ajax: "{{route('allUsers')}}",
        columns: [

            {
                data: 'user_image',
                name: 'user_image'
            },
            {
                data: 'full_name',
                name: 'full_name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'mobile',
                name: 'mobile'
            },
            {
                data: 'update_status',
                name: 'update_status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
    var Inactive = 'Inactive';
    var Active = 'Active';

    function user_status(id, status) {
        $.ajax({
            type: "post",
            url: "{{route('user_status')}}",
            data: {
                _token: '<?php echo csrf_token(); ?>',
                id: id,
                status: status
            },
            success: function(data) {
                var resp = JSON.parse(data);
                $('#status' + resp.id).html(resp.html);
                $(document).find('.child #status' + resp.id).html(resp.html);
            }
        });
    }
</script>
@endsection