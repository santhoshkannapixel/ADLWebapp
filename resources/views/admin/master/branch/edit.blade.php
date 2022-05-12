@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->BranchName }}  
            </div>
           
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            <table class="table m-0 h-100">
                @foreach ($data->toArray() as $column => $value)
                    @if ($column != 'id')
                        <tr>
                            <td width="25%">
                                <strong class="fw-bold ft-cap">{{ Str::headline($column) }}</strong>
                            </td>
                            <td width="5%" class="text-center">:</td>
                            <td width="65%">{{ $value ?? "-" }}</td>
                        </tr>
                    @endif
                @endforeach 
            </table>  
        </div>
    </div>
@endsection 