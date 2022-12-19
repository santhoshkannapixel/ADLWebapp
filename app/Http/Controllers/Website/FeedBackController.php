<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Models\FeedBack;

class FeedBackController extends Controller
{
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'    => 'required|numeric|digits:10',
           
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new FeedBack;
        $data->name      = $request->name;
        $data->email     = $request->email;
        $data->mobile    = $request->mobile;
        $data->location  = $request->location;
        $data->message   = $request->message;
        $res             = $data->save();
        if($res)
        {
                return successCall();
        }

    }
}
