<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Validator;

class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'                 => 'required|regex:/(.+)@(.+)\.(.+)/i',
        ]);
        if($validator->fails()){
            return filedCall($validator->messages()); 
        }
        $data = NewsLetter::where('email',$request->email)->first();
        if(empty($data))
        {
            $news = new NewsLetter();
            $news->email                                             = $request->email;
            $res = $news->save();
        }
        else{
            return response()->json(['Message'=>"Already Your Mail Id Subscribed to our News Letter."]);
        }
        if($res)
        {
                return successCall();
        }

    }
}
