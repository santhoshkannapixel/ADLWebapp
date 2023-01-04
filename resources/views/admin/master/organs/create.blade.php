@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Create Organ 
            </div>
            <a href="{{ route('organ.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Organs List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::open(['route' => 'organ.store', 'id' => 'organ_form', 'method'=> 'post', 'files' => true]) !!}
                @csrf
                @include('admin.master.organs.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('organ.index') }}" class="btn btn-light">back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 