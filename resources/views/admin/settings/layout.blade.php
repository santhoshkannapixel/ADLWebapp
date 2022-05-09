@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['role.index','role.create', 'role.edit']) ? "active" : "" }}" href="{{ route('role.index') }}">
            <i class="fa-users fa me-2"></i>
            Roles
         </a>
      </li>
      <li class="nav-item d-flex">
         <a class="nav-link {{ Route::is(['user.index','user.create', 'user.edit']) ? "active" : "" }}" href="{{ route('user.index') }}">
            <i class="fa-user fa me-2"></i>
            Users 
         </a> 
      </li>
      <li class="nav-item">
         <a class="nav-link" href="#">
            <i class="bi bi-question-circle-fill me-2"></i>
            Help
         </a>
      </li>
   </ul>
   <div class="my-4">
      @yield('admin_settings_content')
   </div>
@endsection