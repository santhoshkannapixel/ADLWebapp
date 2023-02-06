<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs as MailContactUs;
use Illuminate\Http\Request;
use App\Mail\FeedBackMail;
use App\Models\ContactUs;
use Validator;
use Illuminate\Support\Facades\Mail;


class ContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile'    => 'required|numeric|digits:10',
           
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = new ContactUs;
        $data->name      = $request->name;
        $data->email     = $request->email;
        $data->mobile    = $request->mobile;
        $data->location  = $request->location;
        $data->message   = $request->message;
        $res             = $data->save();

        if($res)
        {
            $details = [
                'name'                      => $request->name,
                'mobile'                    => $request->mobile,
                'email'                     => $request->email,
                'location'                  => $request->location,
                'message'                   => $request->message,
                'date_time'                 => now()->toDateString(),

            ];
            try{
                $sent_mail = "donotreply@anandlab.com";
                // $sent_mail = "santhoshd.pixel@gmail.com";
                Mail::to($sent_mail)->send(new MailContactUs($details));
            }catch(\Exception $e){
                $message = 'Thanks for reach us, our team will get back to you shortly. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
            return successCall();
        }

    }
}
