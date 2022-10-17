@extends('admin.reach-us.layout')

@section('admin_reach_us_content') 
    
    <div class="card custom table-card"> 
        <div class="card-header">
            <div class="card-title">
                COVID Testing For Employees
            </div>
            
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Customer Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>Number of Employees</th>
                        <th>How can we help you?</th>
                        <th>Comments</th>
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
                ajax: "{{ route('covidtesting-employees.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'state', name: 'state'},
                    {data: 'city', name: 'city'},
                    {data: 'pincode', name: 'pincode'},
                    {data: 'number_of_employees', name: 'number_of_employees'},
                    {data: 'how_can_we_help_you', name: 'how_can_we_help_you'},
                    {data: 'comments', name: 'comments'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection