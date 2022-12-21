<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BookAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class BookAppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'                          => 'required',
            'location_id'                   => 'required',
            'test_id'                       => 'required',
            'mobile'                        => 'required|numeric|digits:10',
            'file'                        => 'required|mimes:png,jpg,jpeg,csv,xlx,xls,pdf,docx|max:2048',
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new BookAppointment();
        $data->name                                             = $request->name;
        $data->location_id                                      = $request->location_id;
        $data->mobile                                           = $request->mobile;
        $data->test_id                                          = $request->test_id;
        $data->test_type                                        = $request->test_type;
        if($request->file('file'))
        {
            if($request->has('file')) {
                if(Storage::exists($request->file)){
                    Storage::delete($request->file);
                } 
                $file               =  $request->file('file')->store('public/files/appointment');
                $data->file   =  $file;
            }
        }
        $res = $data->save();
        if($res)
        {
                return successCall();
        }

    }
}
