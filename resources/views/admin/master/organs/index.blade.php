@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Organs
            </div>
            <a class="btn btn-primary" href="{{ route('organ.create') }}"><i class="fa fa-plus"></i> Add </a>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Name </th>
                        <th>Image</th> 
                        <th>Sorting Order</th>
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
                ajax: "{{ route('organ.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"name", name : "name"},
                    {data:"image", name : "image"},
                    {data:"order_by", name : "order_by"},
                    {data:"action", name : "action",orderable: false, searchable: false}, 
                ],
            });
        });
    </script>  
@endsection