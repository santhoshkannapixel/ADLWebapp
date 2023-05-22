@extends('layouts.admin')

@section('admin_title')
    Orders
@endsection

@section('admin_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
               Orders
            </div>
            @if (permission_check('ORDERS_EXPORT'))
            <form method="POST" name="dashboard_export" action="{{ route('orders.export') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <button type="submit" id="dashboardExport" class="btn btn-primary" >Export</button>
            </form>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th>#Order ID</th>
                        <th>Customer</th>
                        <th>Is Appoinment</th>
                        <th>Order Date</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
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
                order: [[0, 'desc']],
                ajax: "{{ route('orders.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'customer', name: 'customer'},
                    {data: 'appoinment', name: 'appoinment'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'payment_status', name: 'payment_status'},
                    {data: 'order_status', name: 'order_status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
