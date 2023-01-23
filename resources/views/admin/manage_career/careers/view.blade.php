@extends('admin.manage_career.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Home Visit List
            </div>
           
        </div>
        <div class="card-body"> 
            
              <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                
                   
                <tbody>
                    
                  
                  
                    <tr>
                        <td>Name:</td> <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Job Roll:</td> <td>{{ $data['job']['title'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $data['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>PDF:</td> <td><a href="{{ url('/storage/app/'.$data['file']) }}" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                            <i class="bi bi-download"></i>
                            </a></td>
                    </tr>
                    <tr>
                        <td>Message:</td> <td>{{ $data['message'] }}</td>
                    </tr>
                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('careers.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
