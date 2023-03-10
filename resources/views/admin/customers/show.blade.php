@extends('layouts.admin')

@section('admin_title')
    Customer Details
@endsection

@section('admin_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Customers
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <tbody>
                    <tr>
                        <th width="150px">Name</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $customer->CustomerDetails->first_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $customer->CustomerDetails->last_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $customer->CustomerDetails->phone_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Addrees</th>
                        <td>{{ $customer->CustomerDetails->address ?? '-'}}</td>
                    </tr>
                    <tr>
                        <th>City / Town</th>
                        <td>{{ $customer->CustomerDetails->city_town ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{ $customer->CustomerDetails->state ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pincode</th>
                        <td>{{ $customer->CustomerDetails->pin_code ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
