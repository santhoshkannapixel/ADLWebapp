<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class CurrentOpeningController extends Controller
{
    public function index()
    {
        $data = JobPost::where('job_posts.status',1)
        ->select('job_posts.id','job_posts.title','job_posts.experience',
       'job_posts.code','job_posts.location','job_posts.department_id','job_posts.responsibilities',
       'job_posts.qualification','job_posts.no_of_requirement',
       'departments.name as department_name')
        ->leftJoin('departments','departments.id','job_posts.department_id')
        ->get();
        $current_opening_count = count($data);
        return response()->json(['current_opening_count'=>$current_opening_count,'data'=>$data]);
    }
}
