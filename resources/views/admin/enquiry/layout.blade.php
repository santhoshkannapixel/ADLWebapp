@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['home-collection.index','home-collection.show']) ? "active" : "" }}" href="{{ route('home-collection.index') }}">
            <i class="fa-users fa me-2"></i>
            Home Collection
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Route::is(['patients-consumers.index', 'patients-consumers.show']) ? "active" : "" }}" href="{{ route('patients-consumers.index') }}">
           <i class="fa-users fa me-2"></i>
           Patients Consumers
        </a>
     </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['feedback.index', 'feedback.show']) ? "active" : "" }}" href="{{ route('feedback.index') }}">
           <i class="fa-users fa me-2"></i>
           FeedBack
        </a>
     </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['faq.index', 'faq.show']) ? "active" : "" }}" href="{{ route('faq.index') }}">
           <i class="fa-users fa me-2"></i>
           Frequently Asked Questions
        </a>
     </li>
      
   </ul>
   <div class="my-4">
      @yield('admin_enquiry_content')
   </div>
@endsection