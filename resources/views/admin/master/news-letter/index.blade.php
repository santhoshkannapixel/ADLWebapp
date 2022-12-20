@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                News Letter List
            </div>
         
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No</th>
                        <th>Email</th>
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
                ajax: "{{ route('news-letter.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"email", name : "email"},
                    {data:"action", name : "action", orderable: false, searchable: false}
                ],
            });
        });
    </script>  
@endsection