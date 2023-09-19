<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\FeedBackMail;
use Validator;
use Illuminate\Http\Request;
use App\Models\FeedBack;
use Illuminate\Support\Facades\Mail;

class FeedBackController extends Controller
{
    function formatQacomments($request)
    {
        $qa = [];
        $qac = [];
        $temp = [];
        foreach ($request as $key => $value) {
            $formatedKey = str_replace('-', ' ', str_replace(['QA_', 'QAC_'], '', $key));
            if (strstr($key, 'QA_')) {
                $qa[] = [$formatedKey => $value];
            }
            if (strstr($key, 'QAC_')) {
                $qac[] = [$formatedKey => $value];
            }
        }
        if (strstr( $request['page_url'], 'feedback-b2b')) {
            foreach ($qa as $key => $value) {
                $temp[] = [
                    "question" => ucfirst(array_keys($qac[$key])[0]) . "?",
                    "answer" => array_values($value)[0] ?? '',
                    "comments" => array_values($qac[$key])[0] ?? '',
                ];
            }
            return  $temp;
        } else { 
            foreach ($qa as $key => $value) {
                $temp[] = [
                    "question" => array_keys($value)[0] ?? '-',
                    "answer" => array_values($value)[0] ?? '-',
                ];
            }
            return  $temp;
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'email'  => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile' => 'required|numeric|digits:10'
        ]);
        if ($validator->fails()) {
            return filedCall($validator->messages());
        }
        $question_answer   = $this->formatQacomments($request->all());
        $data              = new FeedBack;
        $data->name        = $request->name;
        $data->email       = $request->email;
        $data->mobile      = $request->mobile;
        $data->location    = $request->location;
        $data->message     = $request->message;
        $data->page_url    = $request->page_url;
        $data->qa_comments = json_encode($question_answer);
        
        if ($data->save()) {
            $details = [
                'name'            => $request->name,
                'mobile'          => $request->mobile,
                'email'           => $request->email,
                'location'        => $request->location,
                'message'         => $request->message,
                'date_time'       => now()->toDateString(),
                'rating_comments' => $request->rating,
                'page_url'        => $request->page_url,
                'question_answer' => $question_answer
            ];
            try {
                Mail::to(config('constant.sentMailId'))->bcc(config('constant.bccMailId'))->send(new FeedBackMail($details));
            } catch (\Exception $e) {
                $message = 'Thanks for reach us, our team will get back to you shortly. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status' => 200, 'Errors' => false, 'Message' => $message]);
            }
            return successCall();
        }
    }
}
