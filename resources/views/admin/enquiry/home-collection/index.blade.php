@extends('admin.enquiry.layout')

@section('admin_enquiry_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                Home Collection
            </div>
            <form method="POST" name="dashboard_export" action="{{ route('home-collection.export') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" id="dashboardExport" class="btn btn-primary" >Export</button>
            </form>
            
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
                      
                        <th>Comments</th>
                        <th>Created At</th>
                        <th>File</th> 
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
                ajax: "{{ route('home-collection.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name' },
                    {data: 'mobile', name: 'mobile'},
                    {data: 'location', name: 'location'},
                    {data: 'test_name', name: 'test_name'},
                    {data: 'comments', name: 'comments'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'download', name: 'download', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection