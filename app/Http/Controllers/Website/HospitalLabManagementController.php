<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\HospitalLabManagement;
use Illuminate\Http\Request;
use Validator;

class HospitalLabManagementController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'hospital_name'         => 'required',
            'hospital_address'      => 'required',
            'name'                  => 'required',
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'                => 'required|numeric|digits:10',
           
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new HospitalLabManagement();
        $data->hospital_name            = $request->hospital_name;
        $data->hospital_address         = $request->hospital_address;
        $data->name                     = $request->name;
        $data->designation              = $request->designation;
        $data->email                    = $request->email;
        $data->mobile                   = $request->mobile;
        $data->message                  = $request->message;
        $res                            = $data->save();
        if($res)
        {
                return successCall();
        }

    }
}
