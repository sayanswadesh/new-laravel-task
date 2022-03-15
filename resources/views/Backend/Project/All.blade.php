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
                            <h3 class="card-title">All Projects</h3>
                            <a href="{{route('addProject')}}" class="btn btn-sm btn-primary float-right mr-2"><i class="fas fa-plus-circle"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Project name</th>
                                        <th>Duration</th>
                                        <th>Client Name</th>
                                        <th>Assign Developer</th>
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
        ajax: "{{route('allProject')}}",
        columns: [{
                data: 'project_name',
                name: 'project_name'
            },
            {
                data: 'duration',
                name: 'duration'
            },
            {
                data: 'client_name',
                name: 'client_name'
            },
            {
                data: 'developer_name',
                name: 'developer_name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
@endsection