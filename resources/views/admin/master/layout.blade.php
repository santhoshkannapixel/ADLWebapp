@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
        @if (permission_check('BRANCH_SHOW'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(["branch.index",'branch.show']) ? "active" : "" }}" href="{{ route('branch.index') }}">
                <i class="fa-cog fa me-2"></i>
                Branch Master
            </a>
        </li>
        @endif
        @if (permission_check('CITY_INDEX'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('city.index') ? "active" : "" }}" href="{{ route('city.index') }}">
                <i class="fa-building fa me-2"></i>
                City Master
            </a>
        </li>
        @endif
        @if (permission_check('TEST_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['test.index','test.show','test.edit']) ? "active" : "" }}" href="{{ route('test.index') }}">
                <i class="fa fa-flask me-2"></i>
                Test Master
            </a>
        </li>
        @endif
        @if (permission_check('BANNER_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['banner.index','banner.create','banner.edit']) ? "active" : "" }}" href="{{ route('banner.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Banner Master
            </a>
        </li>
        @endif
        @if (permission_check('ORDERS_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['organ.index','organ.create','organ.edit']) ? "active" : "" }}" href="{{ route('organ.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Organs
            </a>
        </li>
        @endif
        @if (permission_check('CONDITION_INDEX'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['condition.index','condition.create','condition.edit']) ? "active" : "" }}" href="{{ route('condition.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Conditions
            </a>
        </li>
        @endif
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection
