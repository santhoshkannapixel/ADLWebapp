@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
        @if (permission_check('DEPARTMENT_INDEX'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('department.index','department.edit','department.create') ? "active" : "" }}" href="{{ route('department.index') }}">
                <i class="fa-building fa me-2"></i>
                Department
            </a>
        </li>
        @endif
        @if (permission_check('JOB_POST_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['job-post.index','job-post.create','job-post.edit']) ? "active" : "" }}" href="{{ route('job-post.index') }}">
                <i class="fa-cog fa me-2"></i>
                Job Post
            </a>
        </li>
        @endif
        @if (permission_check('CAREERS_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['careers.index','careers.view']) ? "active" : "" }}" href="{{ route('careers.index') }}">
                <i class="fa-cog fa me-2"></i>
                Career Enquiry
            </a>
        </li>
        @endif
       
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection
