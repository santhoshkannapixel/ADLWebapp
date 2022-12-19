<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ClinicalLabManagement;
use Illuminate\Http\Request;
use Validator;

class ClinicalLabManagementController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'doctors_name'         => 'required',
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'                => 'required|numeric|digits:10',
           
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new ClinicalLabManagement();
        $data->doctors_name                                     = $request->doctors_name;
        $data->specialization                                   = $request->specialization;
        $data->associated_hospitals_clinics                     = $request->associated_hospitals_clinics;
        $data->email                                            = $request->email;
        $data->mobile                                           = $request->mobile;
        $data->message                                          = $request->message;
        $res                                                    = $data->save();
        if($res)
        {
                return successCall();
        }

    }
}
