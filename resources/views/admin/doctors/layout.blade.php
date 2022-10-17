@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['hospital-lab-management.index','hospital-lab-management.show']) ? "active" : "" }}" href="{{ route('hospital-lab-management.index') }}">
            <i class="fa-users fa me-2"></i>
            Hospital Or Lab Management
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Route::is(['clinical-lab-management.index','clinical-lab-management.show']) ? "active" : "" }}" href="{{ route('clinical-lab-management.index') }}">
           <i class="fa-users fa me-2"></i>
           Clinical Lab Management
        </a>
     </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['franchising-opportunities.index','franchising-opportunities.show']) ? "active" : "" }}" href="{{ route('franchising-opportunities.index') }}">
           <i class="fa-users fa me-2"></i>
           Franchising Opportunities
        </a>
     </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['research.index','research.show']) ? "active" : "" }}" href="{{ route('research.index') }}">
           <i class="fa-users fa me-2"></i>
           Research
        </a>
     </li>
      
      
   </ul>
   <div class="my-4">
      @yield('admin_doctors_content')
   </div>
@endsection