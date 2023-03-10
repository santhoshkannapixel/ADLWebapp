@extends('admin.manage_contact.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
               Contact Us
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body"> 
            
              <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                
                   
                <tbody>
                    
                  
                  
                    <tr>
                        <td>Name:</td> <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $data['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td> <td>{{ $data['location'] }}</td>
                    </tr>
                    <tr>
                        <td>Message:</td> <td>{{ $data['message'] }}</td>
                    </tr>
                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('contact-us.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
