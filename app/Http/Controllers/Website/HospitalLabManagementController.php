<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\HospitalLabManagementMail;
use App\Models\HospitalLabManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $details = [
            'hospital_name'            => $request->hospital_name,
            'hospital_address'         => $request->hospital_address,
            'name'                     => $request->name,
            'designation'              => $request->designation,
            'email'                    => $request->email,
            'mobile'                   => $request->mobile,
            'message'                  => $request->message,
        ];
        try{
            $sent_mail = "donotreply@anandlab.com";
            // $sent_mail = "santhoshd.pixel@gmail.com";
            Mail::to($sent_mail)->send(new HospitalLabManagementMail($details));
        }catch(\Exception $e){
            $message = 'Thanks for reach us, our team will get back to you shortly. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
        }

        if($res)
        {
                return successCall();
        }

    }
}
