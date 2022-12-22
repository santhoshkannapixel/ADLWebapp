@extends('layouts.admin')

@section('admin_content')
    <div class="card custom mb-3">
        <div class="card-header rounded">
            <div class="card-title">
                Order Details
                <span class="ms-3 badge bg-white text-primary">
                    <i class="fa fa-user"></i>
                    {{ $order->User->name }}
                </span> |
                <span class="badge bg-white text-primary">
                    <i class="fa fa-clock-o"></i>
                    {{ dateTimeFormat($order->created_at) }}
                </span>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card border shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="header-title mb-3"><b>Billing Information</b></h6>
                    <table class="table">
                        <tr>
                            <th>First Name</th>
                            <td>{{ $order->Customer->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $order->Customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->Customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $order->Customer->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $order->Customer->address }}</td>
                        </tr>
                        <tr>
                            <th>City / Town</th>
                            <td>{{ $order->Customer->city_town }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $order->Customer->state }}</td>
                        </tr>
                        <tr>
                            <th>Pin Code</th>
                            <td>{{ $order->Customer->pin_code }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card border shadow-sm">
                <div class="card-body">
                    <h6 class="header-title mb-3"><b>Order Information</b></h6>
                    <table class="table">
                        <tr>
                            <th>Razorpay Payment ID</th>
                            <td>{{ $order->payment_id }}</td>
                        </tr>
                        <tr>
                            <th>Razorpay Order ID</th>
                            <td>{{ $order->razorpay_order_id }}</td>
                        </tr>
                        <tr>
                            <th>Is Appoinment</th>
                            <td>{{ $order->appoinment == 1 ? "Yes" : 'No' }}</td>
                        </tr>
                        <tr>
                            <th>Appoinment Date & Time</th>
                            <td>{{ dateTimeFormat($order->datetime) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border shadow-sm mb-3">
                <div class="card-body" style="height: 370px;overflow:auto">
                    <h6 class="header-title mb-3"><b>Items from Order</b></h6>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Test ID</th>
                                    <th>Test Name</th>
                                    <th>Test Type</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_price = 0 @endphp
                                @foreach ($order->Tests as $key => $item)
                                    @php $total_price += (int) $item->TestPrice @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->TestId }}</td>
                                        <td>{{ $item->TestName }}</td>
                                        <td>{{ $item->IsPackage == 'Yes' ? 'Test Packages' : 'Lab Test' }}</td>
                                        <td>{{ $item->TestPrice }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card border shadow-sm">
                <div class="card-body text-end">
                    <b>Total Price</b> : {{ $total_price }}
                </div>
            </div>
        </div>
    </div>
@endsection
