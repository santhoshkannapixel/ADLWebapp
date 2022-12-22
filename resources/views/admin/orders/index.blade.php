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
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Payment Id</th>
                        <th>Order Id</th>
                        <th>Customer</th>
                        <th>Is Appoinment</th>
                        <th>Date & Time</th>
                        <th>Payment Status</th>
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
                ajax: "{{ route('orders.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data: 'payment_id', name: 'payment_id'},
                    {data: 'razorpay_order_id', name: 'razorpay_order_id'},
                    {data: 'customer', name: 'customer'},
                    {data: 'appoinment', name: 'appoinment'},
                    {data: 'datetime', name: 'datetime'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
