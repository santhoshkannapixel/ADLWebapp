@extends(request()->route()->type == 'feedback' ? 'admin.enquiry.layout' : 'admin.doctors.layout')
@section(request()->route()->type == 'feedback' ? 'admin_enquiry_content' : 'admin_doctors_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                {{ ucfirst(request()->route()->type) }}
            </div>
            @if (permission_check('FEEDBACK_EXPORT'))
                <form method="POST" name="dashboard_export" action="{{ route('feedback.export', request()->route()->type) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <button type="submit" id="dashboardExport" class="btn btn-primary">Export</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Page URL</th>
                        <th width="200px">Date & Time</th>
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
        $(function() {

            var table = $('#data-table').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                ajax: "{{ route('feedback.index') . '/' . request()->route()->type }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'page_url',
                        name: 'page_url'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
