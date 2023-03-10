@extends('admin.manage_career.layout')

@section('admin_master_content')
<style>
    .btn-light:hover {
    color: #fff;
    background-color: var(--primary2);
    border-color: var(--primary3);
    }
</style>
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Edit Job
            </div>
            <a href="{{ route('job-post.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::model($job,['route' => ['job-post.update', $job->id], 'class'=>'needs-validation','novalidate',  'id' => 'job_edit_form', 'method'=> 'post','files' => true]) !!}
                @csrf
                @include('admin.manage_career.job.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('job-post.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 