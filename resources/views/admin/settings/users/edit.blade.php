@extends('admin.settings.layout')

@section('admin_settings_content')
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Edit User 
            </div>
            <a class="btn btn-primary"  href="{{ route('user.index') }}"><i class="fa fa-arrow-left me-2"></i> Go back</a>
        </div>
        <div class="card-body"> 
            {!! Form::model($user,['route' => ['user.update', $user->id], 'id' => 'role_user_form', 'method'=> 'put']) !!}
                @csrf
                <div class="row mb-3">
                    <label class="col-2 text-end col-form-label">Name</label>
                    <div class="col-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-2 text-end col-form-label">Email</label>
                    <div class="col-10">
                        {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-2 text-end col-form-label">Password</label>
                    <div class="col-10">
                        {!! Form::text('new_password', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-2 text-end col-form-label">Role</label>
                    <div class="col-10">
                        {!! Form::select('role_id',$roleDb , $userRole, ['class' =>'form-select', 'placeholder' => '-- Select Role --'])  !!}
                    </div>
                </div>
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('user.index') }}" class="btn btn-light">back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection
