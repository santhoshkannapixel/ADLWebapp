@extends('admin.manage_career.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Job Post List
            </div>
            <a href="{{ route('job-post.create') }}" class="btn btn-primary ms-3">
                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                Add New
            </a>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Department</th>
                        <th>Qualification</th>
                        <th>Status</th>
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
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                // processing: true,
                // responsive: true,
                // serverSide: true,
                ajax: "{{ route('job-post.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"title", name : "title"},
                    {data:"code", name : "code"},
                    {data:"department.name", name : "department.name"},
                    {data:"qualification", name : "qualification"},
                    {data:"status", name : "status"},
                    {data:"action", name : "action", orderable: false, searchable: false}
                ],
            });
        });
    </script>  
@endsection