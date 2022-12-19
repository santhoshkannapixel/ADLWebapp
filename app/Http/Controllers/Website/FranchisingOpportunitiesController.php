<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\FranchisingOpportunities;
use Illuminate\Http\Request;
use Validator;


class FranchisingOpportunitiesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'                  => 'required',
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'                => 'required|numeric|digits:10',
            'city'                  => 'required',
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new FranchisingOpportunities();
        $data->name                     = $request->name;
        $data->email                    = $request->email;
        $data->mobile                   = $request->mobile;
        $data->city                     = $request->city;
        $data->message                  = $request->message;
        $res                            = $data->save();
        if($res)
        {
                return successCall();
        }

    }
}
