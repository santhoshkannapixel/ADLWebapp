@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
      @if (permission_check('HOME_COLLECTION_INDEX'))
      <li class="nav-item">
         <a class="nav-link {{ Route::is(['home-collection.index','home-collection.show']) ? "active" : "" }}" href="{{ route('home-collection.index') }}">
            <i class="fa-users fa me-2"></i>
            Home Collection
         </a>
      </li>
      @endif
      @if (permission_check('PATIENTS_CONSUMERS_INDEX'))
      <li class="nav-item">
        <a class="nav-link {{ Route::is(['patients-consumers.index', 'patients-consumers.show']) ? "active" : "" }}" href="{{ route('patients-consumers.index') }}">
           <i class="fa-users fa me-2"></i>
           Patients Consumers
        </a>
     </li>
     @endif
     @if (permission_check('FEEDBACK_INDEX'))
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['feedback.index', 'feedback.show']) ? "active" : "" }}" href="{{ route('feedback.index') }}/feedback">
           <i class="fa-users fa me-2"></i>
           FeedBack
        </a>
     </li>
     @endif
     @if (permission_check('FAQ_INDEX'))
     <li class="nav-item">
        <a class="nav-link {{ Route::is(['faq.index', 'faq.show']) ? "active" : "" }}" href="{{ route('faq.index') }}">
           <i class="fa-users fa me-2"></i>
           Frequently Asked Questions
        </a>
     </li>
      @endif
   </ul>
   <div class="my-4">
      @yield('admin_enquiry_content')
   </div>
@endsection