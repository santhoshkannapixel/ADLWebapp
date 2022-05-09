@extends('admin.settings.layout')

@section('admin_settings_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Users List
            </div>
            <a class="btn btn-primary"  href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Add User</a>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th class="table-th">No</th>
                        <th class="table-th">Name</th>
                        <th class="table-th">Email</th>
                        <th class="table-th">Role</th>
                        <th class="table-th">Last Login</th>
                        <th class="table-th">Status</th>
                        <th class="table-th" width="100px">Action</th>
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
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role', defaultContent: '',},
                    {data: 'last_login', name: 'last_login'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>  
@endsection