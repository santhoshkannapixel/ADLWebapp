@extends('admin.manage_contact.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Careers
            </div>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email </th>
                        <th>Location</th>
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
               
                ajax: "{{ route('contact-us.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"name", name : "name"},
                    {data:"mobile", name : "mobile"},
                    {data:"email", name : "email"},
                    {data:"location", name : "location"},
                    {data:"action", name : "action",orderable: false},
                    
                ],
            });
        });
        
       
    </script>  
@endsection