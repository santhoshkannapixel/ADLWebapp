<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobPost;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = JobPost::with('department')
            ->select('*')->orderBy('job_posts.created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $edit = '';
                    $delete = '';
                    $edit=button('edit',route('job-post.edit', $data->id));
                    $delete = button('delete',route('job-post.destroy', $data->id));
                    return $edit.$delete;
                })
                ->addColumn('status', function ($data) {
                    $flag    =  $data->status == '0' ? 'danger' : 'success';
                    $type    =  $data->status == '0' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.manage_career.job.index');
    }
    public function create()
    {
        $department =Department::where('status',1)->get()->pluck('name','id');
        return view('admin.manage_career.job.create',compact('department'));
    }
    public function store(Request $request,$id=null)
    {
        $this->validate($request, [
            
            'title' => 'required|unique:job_posts,title,'. $id.',id,deleted_at,NULL',
            'code' => 'required|unique:job_posts,code,'. $id.',id,deleted_at,NULL',
            'experience' => 'required',
        ]);
        
            $data = new JobPost;
            $data->title                    = $request->title;
            $data->code                     = $request->code;
            $data->location                 = $request->location;
            $data->department_id            = $request->department_id;
            $data->experience               = $request->experience;
            $data->responsibilities         = $request->responsibilities;
            $data->qualification            = $request->qualification;
            $data->no_of_requirement        = $request->no_of_requirement;
            $data->status                   = $request->status;
            $res =  $data->save();
           
        if($res)
        {
         Flash::success( __('action.saved', ['type' => 'Job Post']));
        }
        return redirect()->route('job-post.index');
    }
    public function edit($id)
    {
        $job = JobPost::find($id);
        $department =Department::where('status',1)->get()->pluck('name','id');
       
        return view('admin.manage_career.job.edit',compact('job','department'));
    }
    public function update(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'title' => 'required|unique:job_posts,title,'. $id.',id,deleted_at,NULL',
            'code' => 'required|unique:job_posts,code,'. $id.',id,deleted_at,NULL',
            'experience' => 'required',
        ]);
        
            $data = JobPost::find($id);
            $data->title                    = $request->title;
            $data->code                     = $request->code;
            $data->location                 = $request->location;
            $data->department_id            = $request->department_id;
            $data->experience               = $request->experience;
            $data->responsibilities         = $request->responsibilities;
            $data->qualification            = $request->qualification;
            $data->no_of_requirement        = $request->no_of_requirement;
            $data->status                   = $request->status;
            $res =  $data->update();
            if($res)
            {
             Flash::success( __('action.updated', ['type' => 'Job Post']));
            }
            return redirect()->route('job-post.index');
    }
    public function delete($id = null)
    {
        $job  = JobPost::find($id);
        $job->delete();
        Flash::success(__('action.deleted', ['type' => 'Job Post']));
        return redirect()->back();
    }
}
