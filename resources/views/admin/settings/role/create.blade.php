@extends('admin.settings.layout')

@section('admin_settings_content') 
    <div class="card custom"> 
        <div class="card-header">
            <div class="card-title">
                New Role
            </div>
            <a class="btn btn-primary"  href="{{ route('role.index') }}"><i class="fa fa-list"></i>  Role List</a>
        </div>
        
        {!! Form::open(['route' => 'role.store',"id" => "roleForm", "Method" => "POST"]) !!}
            <div class="card-body"> 
                @include('admin.settings.role.form')
            </div>
            <div class="text-end card-footer">
                <a href="{{ route('role.index') }}" class="btn btn-light bg-white me-2">back</a>
                <button type="submit" class="btn btn-primary fw-bold">Save</button>
            </div> 
        {!! Form::close() !!}
        
    </div>
@endsection 