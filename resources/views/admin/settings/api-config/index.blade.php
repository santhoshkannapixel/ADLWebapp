@extends('admin.settings.layout')

@section('admin_settings_content') 
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                API Configuration 
            </div> 
            <a href="{{ route('api_config.create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i> Add New</a>
        </div>
        <div class="card-body">
            <table class="table" id="data-table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Corporate ID</th>
                        <th>Pass Code</th>
                        <th>Base Url</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
 
@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
    
        $(document).ready(function(){
            $('#data-table').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax: "{{ route('api_config.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'CorporateID', CorporateID: 'name'},
                    {data: 'passCode', name: 'passCode'},
                    {data: 'BaseUrl', name: 'BaseUrl'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action',orderable: false, searchable: false},

                ],
            });
        });
    </script>
@endsection