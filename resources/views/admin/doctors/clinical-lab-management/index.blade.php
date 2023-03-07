@extends('admin.doctors.layout')

@section('admin_doctors_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                Clinical Lab Management
            </div>
            <form method="POST" name="dashboard_export" action="{{ route('clinical-lab-management.export') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" id="dashboardExport" class="btn btn-primary" >Export</button>
            </form>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Associated Hospitals/Clinics</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Message</th>
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
                ajax: "{{ route('clinical-lab-management.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'doctors_name', name: 'doctors_name'},
                    {data: 'specialization', name: 'specialization'},
                    {data: 'associated_hospitals_clinics', name: 'associated_hospitals_clinics'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'message', name: 'message'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection