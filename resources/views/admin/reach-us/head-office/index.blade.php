@extends('admin.reach-us.layout')

@section('admin_reach_us_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Healthcheckup for employees
            </div>
            @if (permission_check('HEALTHCHECKUP_FOR_EMPLOYEE_EXPORT'))
                <form method="POST" name="dashboard_export" class="d-flex input-daterange"
                    action="{{ route('healthcheckup-for-employee.export') }}" >
                    @csrf
                    <button type="button" name="refresh" id="refresh" class="btn btn-warning form-control-sm">
                        <i class="fa fa-repeat" aria-hidden="true"></i>
                    </button>
                    <input type="text" name="start_date" id="start_date"
                        class="mx-1 btn form-control form-control-sm text-start" placeholder="From Date" readonly />
                    <input type="text" name="end_date" id="end_date"
                        class="mx-1 btn form-control form-control-sm text-start" placeholder="To Date" readonly />
                    <button type="button" name="filter" id="filter" class="btn btn-primary mx-1 form-control-sm">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    <button type="submit" id="dashboardExport" class="mx-1 btn btn-success form-control-sm">Export</button>
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
                        <th>Company Name</th>
                        <th>Designation</th>
                        <th>Message</th>
                        <th>Date & Time</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            function load_data(start_date = '', end_date = '') {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                $('#data-table').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('healthcheckup-for-employee.index') }}",
                        data: {
                            start_date: start_date,
                            end_date: end_date,
                        }
                    },
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
                            data: 'company_name',
                            name: 'company_name'
                        },
                        {
                            data: 'designation',
                            name: 'designation'
                        },
                        {
                            data: 'message',
                            name: 'message'
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
            }
            load_data();
            $('#filter').click(function() {
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                $('#data-table').DataTable().destroy();
                load_data(start_date, end_date);
            });

            $('#refresh').click(function() {
                $('#start_date').val('');
                $('#end_date').val('');
                $('#data-table').DataTable().destroy();
                load_data();
            });
        });
    </script>
@endsection
