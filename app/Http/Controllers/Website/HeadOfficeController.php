<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\HeadOffice;
use Illuminate\Http\Request;
use Validator;

class HeadOfficeController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            
            'name'                  => 'required',
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'                => 'required|numeric|digits:10',
            'company_name'         => 'required',
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new HeadOffice();
        
        $data->name                     = $request->name;
        $data->email                    = $request->email;
        $data->mobile                   = $request->mobile;
        $data->company_name             = $request->company_name;
        $data->address                  = $request->address;
        $data->designation              = $request->designation;
        $data->message                  = $request->message;
        $res                            = $data->save();
        if($res)
        {
            return successCall();
        }

    }
}
