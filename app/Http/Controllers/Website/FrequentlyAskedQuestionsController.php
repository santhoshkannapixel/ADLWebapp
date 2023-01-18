<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\FrequentlyAskedQuestionsMail;
use Illuminate\Http\Request;
use Validator;
use App\Models\FrequentlyAskedQuestions;
use Illuminate\Support\Facades\Mail;

class FrequentlyAskedQuestionsController extends Controller
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
        $data = new FrequentlyAskedQuestions;
        $data->name      = $request->name;
        $data->email     = $request->email;
        $data->mobile    = $request->mobile;
        $data->location  = $request->location;
        $data->message   = $request->message;
        $res             = $data->save();

        $details = [
            'name'                      => $request->name,
            'mobile'                    => $request->mobile,
            'email'                     => $request->email,
            'location'                  => $request->location,
            'message'                   => $request->message,
        ];
        try{
            $sent_mail = "donotreply@anandlab.com";
            // $sent_mail = "santhoshd.pixel@gmail.com";
            Mail::to($sent_mail)->send(new FrequentlyAskedQuestionsMail($details));
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
