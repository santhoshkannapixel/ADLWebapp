@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
     @if (permission_check('BOOK_AN_APPOINTMENT_INDEX'))
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['book-an-appointment.index','book-an-appointment.show']) ? "active" : "" }}" href="{{ route('book-an-appointment.index') }}">
            <i class="fa-users fa me-2"></i>
            Book an Appointment
         </a>
      </li>
      @endif
   </ul>
   <div class="my-4">
      @yield('admin_health_checkup_content')
   </div>
@endsection