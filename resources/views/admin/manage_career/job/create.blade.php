@extends('admin.manage_career.layout')

@section('admin_master_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Create Job Post 
            </div>
            <a href="{{ route('job-post.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Job Post  List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::open(['route' => 'job-post.store', 'id' => 'job_form', 'method'=> 'post', 'files' => true]) !!}
                @csrf
                @include('admin.manage_career.job.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('job-post.index') }}" class="btn btn-light">back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 