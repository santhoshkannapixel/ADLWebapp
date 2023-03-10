@extends('layouts.admin')
@section('admin_title')
    Edit News & Events
@endsection
@section('admin_content')
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                News & Events List
            </div>
            <a class="btn btn-primary" href="{{ route('news-and-events.index') }}"><i class="fa fa-arrow-left me-2"></i> Go back </a>
        </div>
        <div class="card-body">
            {!! Form::model($data, ['route' => ['news-and-events.update',$data->id],"class" => "py-4", 'method'=> 'POST']) !!}
                @csrf
                @include('admin.news-and-events.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('news-and-events.index') }}" class="btn btn-light">back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
