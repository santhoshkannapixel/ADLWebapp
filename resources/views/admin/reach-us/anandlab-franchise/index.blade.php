@extends('admin.reach-us.layout')

@section('admin_reach_us_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                Anand Franchise
            </div>
            
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Pincode</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Ownership</th>
                        <th>Profession</th>
                        <th>Association with LPL</th>
                        <th>Mobile</th>
                        <th>Email</th>
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
                ajax: "{{ route('anandlab-franchise.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'pincode', name: 'pincode'},
                    {data: 'state', name: 'state'},
                    {data: 'city', name: 'city'},
                    {data: 'ownership', name: 'ownership'},
                    {data: 'profession', name: 'profession'},
                    {data: 'association_with_LPL', name: 'association_with_LPL'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection