@extends('layouts.admin')

@section('admin_title')
    Orders
@endsection

@section('admin_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Lab Test Orders
            </div>
            <a class="btn btn-primary" href="{{ route('news-and-events.create') }}"><i class="fa fa-plus"></i> Add </a>
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
                processing: true,
                serverSide: true,
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
