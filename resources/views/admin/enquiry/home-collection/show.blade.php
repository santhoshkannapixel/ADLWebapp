@extends('admin.enquiry.layout')

@section('admin_enquiry_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->name }}  
            </div>
           
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            <table class="table m-0 h-100">
                @foreach ($data->toArray() as $column => $value)
                    @if ($column != 'id' && $column != 'file')
                        <tr>
                            <td width="25%">
                                <strong class="fw-bold ft-cap">{{ Str::headline($column) }}</strong>
                            </td>
                            <td width="5%" class="text-center">:</td>
                            <td width="65%">{{ $value ?? "-" }}</td>
                        </tr>

                    @endif
                    @if($column == 'file')
                    <tr>
                        <td width="25%">
                            <strong class="fw-bold ft-cap">{{ Str::headline($column) }}</strong>
                        </td>
                        <td width="5%" class="text-center">:</td>
                        <td width="65%">
                            <a href="{{asset_url($data->file)}}" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                               <i class="bi bi-download"></i>
                            </a>
                        </td>
                    </tr>
                    @endif
                   
                @endforeach 
            </table>  
        </div>
    </div>
@endsection 