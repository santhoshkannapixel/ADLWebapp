@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Banners List
            </div>
            <a href="{{ route('banner.create') }}" class="btn btn-primary ms-3">
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
                        <th>Url</th>
                        <th>DesktopImage</th>
                        <th>MobileImage</th>
                        <th>OrderBy</th>
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
                ajax: "{{ route('banner.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"Title", name : "Title"},
                    {data:"Url", name : "Url"},
                    {data:"Desktop_Image", name : "Desktop_Image",orderable: false, searchable: false},
                    {data:"Mobile_Image", name : "Mobile_Image",orderable: false, searchable: false},
                    {data:"OrderBy", name : "OrderBy"},
                    {data:"action", name : "action", orderable: false, searchable: false}
                ],
            });
        });
    </script>  
@endsection