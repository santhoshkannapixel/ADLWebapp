@extends('admin.master.layout')

@section('admin_master_content')
    {!! Form::model($data, ['route' => ['test.edit', $data->id], 'Method' => 'POST', 'files' => true]) !!}
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->TestName }}
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">TestId</label>
                <div class="col-10">
                    {!! Form::text('TestId', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">TestName</label>
                <div class="col-10">
                    {!! Form::text('TestName', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Test Images</label>
                <div class="col-10">
                    <input type="file" name="image" class="form-control">
                    <br>
                    <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                    @if ($data->image)
                        <img src="{{  asset_url($data->image) }}" width="80px">
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-2 text-end col-form-label">Sorting Order</label>
                <div class="col-3">
                    <input type="number" class="form-control" name="sorting_order" value="{{ $data->sorting_order }}"  id="sorting_order">
                </div>
            </div>
            <div class="row ">
                <label class="col-2 text-end col-form-label">Is Home</label>
                <div class="col-10">
                    <input type="checkbox" class="checkbox" name="is_home" @if(isset($data->is_home) && $data->is_home == 1) checked @endif  id="is_home">
                </div>
            </div>
        </div>
        <div class="text-end card-footer">
            <a href="{{ route('test.index') }}" class="btn btn-light bg-white me-2">back</a>
            <button type="submit" class="btn btn-primary fw-bold">Save</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection 