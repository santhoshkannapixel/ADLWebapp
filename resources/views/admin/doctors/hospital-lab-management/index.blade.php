@extends('admin.doctors.layout')

@section('admin_doctors_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                Hospital Lab Management
            </div>
            
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Hospital Name</th>
                        <th>Hospital Address</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Designation</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('hospital-lab-management.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'hospital_name', name: 'hospital_name'},
                    {data: 'hospital_address', name: 'hospital_address'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'designation', name: 'designation'},
                    {data: 'message', name: 'message'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection