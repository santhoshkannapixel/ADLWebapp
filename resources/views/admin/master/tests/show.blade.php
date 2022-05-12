@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                {{ $data->TestName }} <span class="ms-3 badge bg-white text-primary">₹ . {{ $data->TestPrice}} </span> 
            </div>
           
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            <div class="row p-0 m-0">
            
                <table class="table m-0 table-bordered h-100">
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
            <table class="table mt-4 table-borderless">
                @if ($data->SubTestList()->exists())
                       
                    <tr class="bg-light border">
                        <td colspan="3" class="text-center">
                            <strong class="fw-bold ft-cap">Sub Tests</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding: 0 !important">
                            <div class="row m-0 p-0">
                                @foreach ($data->SubTestList as $key => $subTest)
                                    <div class="d-flex col-4 border p-3 align-items-center">
                                        <i class="fa fa-flask me-3" aria-hidden="true"></i>
                                        <div class=""> {{ $subTest->SubTestName }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endsection 