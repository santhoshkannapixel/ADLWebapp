@extends('admin.settings.layout')

@section('admin_settings_content')
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Create New Users
            </div>
            <a class="btn btn-primary"  href="{{ route('user.index') }}"><i class="fa fa-list"></i> User Lists</a>
        </div>
        <div class="card-body"> 
            {!! Form::open(['route' => 'user.store', 'id' => 'role_user_form', 'method'=> 'post']) !!}
                @csrf
                @include('admin.settings.users.form')
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
