@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Branch List
            </div>
           
            <form action="{{ route('branch.sync') }}" method="POST">
                @csrf
                <small><b>Last Sync</b> :  {{ $last_sync }}</small>
                <button type="submit" class="btn btn-primary ms-3">
                    <i class="fa fa-refresh me-2" aria-hidden="true"></i>
                    Sync Data</button>
            </form>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No</th>
                        <th>Branch Code</th>
                        <th>Branch Name</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Processing</th>
                        <th>State</th>
                        <th>Pincode</th>
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
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('master.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"BranchCode", name : "BranchCode"},
                    {data:"BranchName", name : "BranchName"},
                    {data:"BranchCity", name : "BranchCity"},
                    {data:"BrachContact", name : "BrachContact"},
                    {data:"BranchEmail", name : "BranchEmail"},
                    {data:"processing", name : "IsProcessingLocation"},
                    {data:"State", name : "State"}, 
                    {data:"Pincode", name : "Pincode",},
                    {data:"action", name : "action",}
                ],
            });
        });
        
    </script>  
@endsection