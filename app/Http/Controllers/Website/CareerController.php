<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function getJobDetail($id)
    {
        $jobDetail = JobPost::where('job_posts.id',$id)
        ->select('job_posts.id','job_posts.title','job_posts.code','job_posts.location','job_posts.department_id','job_posts.experience',
        'job_posts.responsibilities','job_posts.qualification','job_posts.no_of_requirement','departments.name as department_name')
        ->leftJoin('departments','departments.id','job_posts.department_id')
        ->first();
        if(!empty($jobDetail))
        {
            return response()->json(['job'=>$jobDetail]);
        }
        else{
            return response()->json(['Message'=>"Data not Find"]);
        }
    }
}
