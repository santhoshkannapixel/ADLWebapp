@extends('admin.settings.layout')

@section('admin_settings_content') 
    <div class="card  custom"> 
        <div class="card-header">
            <div class="card-title">
                Edit Role
            </div>
            <a class="btn btn-primary"  href="{{ route('role.index') }}"><i class="fa fa-list"></i>  Role List</a>
        </div>
        {!! Form::model($role, ['route' => ['role.update',$role->id],"id" => "roleForm", 'method'=> 'put']) !!}
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