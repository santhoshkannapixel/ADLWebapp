@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      @if (permission_check('ROLE_INDEX'))
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['role.index','role.create', 'role.edit']) ? "active" : "" }}" href="{{ route('role.index') }}">
            <i class="fa-users fa me-2"></i>
            Roles
         </a>
      </li>
      @endif
      @if (permission_check('USER_INDEX'))
      <li class="nav-item d-flex">
         <a class="nav-link {{ Route::is(['user.index','user.create', 'user.edit']) ? "active" : "" }}" href="{{ route('user.index') }}">
            <i class="fa-user fa me-2"></i>
            Users 
         </a> 
      </li>
      @endif
      @if (permission_check('API_CONFIG_INDEX'))
      <li class="nav-item">
         <a class="nav-link  {{ Route::is(['api_config.index','api_config.create', 'api_config.edit']) ? "active" : "" }}" href="{{ route('api_config.index') }}">
            <i class="fa fa-usb me-2"></i>
            API config
         </a>
      </li>
      @endif
      @if (permission_check('PAYMENT_CONFIG_INDEX'))
      <li class="nav-item">
         <a class="nav-link  {{ Route::is(['payment_config.index','payment_config.create', 'payment_config.edit']) ? "active" : "" }}" href="{{ route('payment_config.index') }}">
            <i class="fa fa-inr me-2"></i>
            Payment config
         </a>
      </li>
      @endif
   </ul>
   <div class="my-4">
      @yield('admin_settings_content')
   </div>
@endsection