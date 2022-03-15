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
                            <h3 class="card-title">{{$project_details['menu_name']}} Addon List</h3>
                            <a href="{{route('allProject')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            <a href="{{route('addTask',['project_id'=>$project_id])}}" class="btn btn-sm btn-primary float-right mr-2"><i class="fas fa-plus-circle"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
<!-- SweetAlert2 -->
<script src="{{url('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#dataTable').DataTable({
            "responsive": true,
            processing: true,
            serverSide: true,
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all"
            }],
            order: [],
            ajax: {
                url: "{{route('allTask',['project_id'=>$project_id])}}",
                type: 'GET',
            },
            columns: [{
                    data: 'task_name',
                    name: 'task_name'
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
                },
            ]
        });
    });
    var Pending = 'Pending';
    var Complete = 'Complete';

    function task_status(id, status) {
        $.ajax({
            type: "post",
            url: "{{route('task_status')}}",
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