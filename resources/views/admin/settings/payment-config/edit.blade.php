@extends('admin.settings.layout')

@section('admin_settings_content') 
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Payment Configuration 
            </div> 
            <a href="{{ route('payment_config.index') }}" class="btn btn-primary"><i class="fa fa-list me-2"></i> Appi List</a>
        </div>

        {!! Form::model($paymentConfig,['route' =>['payment_config.store' , $paymentConfig->id] , "roleForm", "Method" => "POST"]) !!}
            <div class="card-body"> 
                @include('admin.settings.payment-config.form')
            </div>
            <div class="text-end card-footer">
                <a href="{{ route('payment_config.index') }}" class="btn btn-light bg-white me-2">back</a>
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
            </div> 
        {!! Form::close() !!}
 
    </div>
@endsection 