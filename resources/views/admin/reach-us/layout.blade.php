@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['healthcheckup-for-employee.index','healthcheckup-for-employee.show']) ? "active" : "" }}" href="{{ route('healthcheckup-for-employee.index') }}">
            <i class="fa-users fa me-2"></i>
            Healthcheckup for employees
         </a>
      </li>
      {{-- <li class="nav-item">
         <a class="nav-link {{ Route::is(['anandlab-franchise.index','anandlab-franchise.show']) ? "active" : "" }}" href="{{ route('anandlab-franchise.index') }}">
            <i class="fa-users fa me-2"></i>
            Anand Franchise
         </a>
      </li> --}}
      {{-- <li class="nav-item">
         <a class="nav-link {{ Route::is(['covidtesting-employees.index','covidtesting-employees.show']) ? "active" : "" }}" href="{{ route('covidtesting-employees.index') }}">
            <i class="fa-users fa me-2"></i>
            COVID Testing For Employees
         </a>
      </li> --}}
      
      
   </ul>
   <div class="my-4">
      @yield('admin_reach_us_content')
   </div>
@endsection