@extends('admin.manage_career.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Careers
            </div>
           
            {{-- <a href="{{ route('home_visit.create') }}" class="btn btn-primary ms-3">
                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                Add New
            </a> --}}
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Date </th>
                        <th>Name</th>
                        <th>Job Roll</th>
                        <th>Mobile</th>
                        <th>Email </th>
                        <th>Resume</th>
                        <th>Action</th>
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
                "pageLength": 50,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('careers.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"created_at", name : "created_at"},
                    {data:"name", name : "name"},
                    {data:"job.title", name : "job.title"},
                    {data:"mobile", name : "mobile"},
                    {data:"email", name : "email"},
                    {data:"download", name : "download",orderable: false},
                    {data:"action", name : "action",orderable: false},
                    
                ],
            });
        });
        
       
    </script>  
@endsection