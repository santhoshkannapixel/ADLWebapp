@extends('admin.settings.layout')

@section('admin_settings_content') 
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Payment Configuration 
            </div> 
            <a href="{{ route('payment_config.create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i> Add New</a>
        </div>
        <div class="card-body">
            <table class="table" id="data-table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Payment Gateway Name</th>
                        <th>Payment Key / Id</th>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#data-table').DataTable({
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax: "{{ route('payment_config.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'gateWayName', name: 'gateWayName'},
                    {data: 'payKeyId', name: 'payKeyId'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action',orderable: false, searchable: false},

                ],
            });
        });
    </script>
@endsection