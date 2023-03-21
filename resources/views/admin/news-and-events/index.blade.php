@extends('layouts.admin')

@section('admin_title')
    Home
@endsection

@section('admin_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                News & Events
            </div>
            @if (permission_check('NEWS_AND_EVENTS_CREATE'))
            <a class="btn btn-primary" href="{{ route('news-and-events.create') }}"><i class="fa fa-plus"></i> Add </a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Posted At</th>
                        <th>Posted By</th>
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
                order: [ [3, 'desc'] ],
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax: "{{ route('news-and-events.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'posted_by', name: 'posted_by'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
