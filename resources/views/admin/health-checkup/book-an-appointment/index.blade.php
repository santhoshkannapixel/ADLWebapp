@extends('admin.health-checkup.layout')

@section('admin_health_checkup_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                Book an Appointment
            </div>
            @if (permission_check('BOOK_AN_APPOINTMENT_EXPORT'))
            <form method="POST" name="dashboard_export" action="{{ route('book-an-appointment.export') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" id="dashboardExport" class="btn btn-primary" >Export</button>
            </form>
            @endif
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Location</th>
                        <th>Test Name</th>
                        <th>Test Type</th>
                        <th>File</th>
                        <th>Created At</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection 

@section('scripts')
    <script type="text/javascript">
        $(function () {
        
            var table = $('#data-table').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ajax: "{{ route('book-an-appointment.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'location.AreaName', name: 'location.AreaName'},
                    {data: 'test.TestName', name: 'test.TestName'},
                    {data: 'test_type', name: 'test_type'},
                    {data: 'download', name: 'download'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection