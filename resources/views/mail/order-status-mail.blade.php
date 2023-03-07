@component('mail::message')
    <div class="card border shadow-sm mb-3">
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>
                        <img src="{{ asset('public/images/logo/logo.png') }}"  width="200" alt="logo">
                    </td>
                    <td>
                        <div>Order #ID: <b> {{ $data['order']['order_id'] }}</b></div>
                        <div>Order Status:  <b>{{ $data['order_status'] }}</b></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <p>Dear <b>{{ $data['customer']['first_name'] . ' ' . $data['customer']['last_name'] }}</b>, </p>
    <p>
        Thank you for your booking. we will send a confirmation mail
        <br> For more Queries visit <a href="https://www.anandlab.com/my-account">anandlab.com</a>
    </p>
    <div class="card border shadow-sm mb-3">
        <div class="card-body">
            <h6 class="header-title mb-3"><b>Billing Information</b></h6>
            <table class="table">
                <tr>
                    <td><small><b>First Name</b></small></td>
                    <td><small>{{ $data['customer']['first_name'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>Last Name</b></small></td>
                    <td><small>{{ $data['customer']['last_name'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>Email</b></small></td>
                    <td><small>{{ $data['customer']['email'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>Phone Number</b></small></td>
                    <td><small>{{ $data['customer']['phone_number'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>Address</b></small></td>
                    <td><small>{{ $data['customer']['address'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>City / Town</b></small></td>
                    <td><small>{{ $data['customer']['city_town'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>State</b></small></td>
                    <td><small>{{ $data['customer']['state'] }}</small></td>
                </tr>
                <tr>
                    <td><small><b>Pin Code</b></small></td>
                    <td><small>{{ $data['customer']['pin_code'] }}</small></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card border shadow-sm mb-3">
        <div class="card-body">
            <h6 class="header-title mb-3"><b>Order Information</b></h6>
            <table class="table">
                <tr>
                    <td><small><b>Home Booking </b></small></td>
                    <td><small>{{ $data['order']['appoinment'] == 1 ? 'Yes' : 'No' }}</small></td>
                </tr>
                @if ($data['order']['appoinment'] == 1)
                    <tr>
                        <td><small><b>Appoinment Date & Time</b></small></td>
                        <td><small>{{ dateTimeFormat($data['order']['datetime']) }}</small></td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="card border shadow-sm mb-3">
        <div class="card-body" style="max-height: 370px;overflow:auto">
            <h6 class="header-title mb-3"><b>Items from Order</b></h6>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><small>Test Name</small></th>
                            <th><small>Type</small></th>
                            <th><small>Price</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total_price = 0 @endphp
                        @foreach ($data['tests'] as $key => $item)
                            @php $total_price += (int) $item->TestPrice @endphp
                            <tr>
                                <td><small>{{ $key + 1 }}</small></td>
                                <td><small>{{ $item->TestName }}</small></td>
                                <td><small>{{ $item->IsPackage == 'Yes' ? 'Test Packages' : 'Lab Test' }}</small></td>
                                <td style="text-align:right"><small>₹{{ $item->TestPrice }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card border shadow-sm mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <span style="font-size: 16px;color:{{ $data['order']['payment_status'] == 1 ? 'green' : 'red' }} "
                    class="me-2">
                    <b>{{ $data['order']['payment_status'] == 1 ? 'Payment Success' : 'Payment Failed' }}</b>
                </span>
            </div>
            <div>
                Total Price : <b>₹ {{ $total_price }}</b>
            </div>
        </div>
    </div>
    <center>
        <br>
        Thanks,<br>
        <strong>Anand Lab Team</strong>
    </center>
@endcomponent
