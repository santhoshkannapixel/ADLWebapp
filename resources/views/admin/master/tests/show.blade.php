@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->BranchName }} | {{ $data->BranchCode }}
            </div>
           
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            <div class="row p-0 m-0">
                @foreach ($data->toArray() as $column => $value)
                    <div class="col-6 p-0">
                        <table class="table m-0 table-bordered h-100">
                            <tr>
                                <td width="30%"><strong class="fw-bold ft-cap">{{ $column }}</strong></td>
                                <td width="5%">:</td>
                                <td width="65%">{{ $value }}</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 