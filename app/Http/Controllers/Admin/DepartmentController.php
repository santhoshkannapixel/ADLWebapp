<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Department::select([
                'id',
                'name',
                'status'
            ]);
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $flag    =  $data->status == '0' ? 'danger' : 'success';
                    $type    =  $data->status == '0' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                })

                ->addColumn('action', function ($data) {
                    return button('edit',route('department.edit', $data->id)).button('delete',route('department.destroy', $data->id));
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }

        return view('admin.manage_career.department.index');
    }
    public function create()
    {
        return view('admin.manage_career.department.create');
    }
    public function store(Request $request, $id = null)
    { 
        $request->validate([
            'name'       => 'required|unique:departments,name,'. $id.',id,deleted_at,NULL',
        ],[ 'name.unique' => 'Name Already been Taken' ]);
        $result = Department::create([
            'name'          => $request->name,
            'status'        => $request->status,
        ]);
        
        Flash::success( __('action.saved', ['type' => 'Department']));
        return redirect()->route('department.index');
    }
    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.manage_career.department.edit',compact('department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|unique:departments,name,'.$id.',id,deleted_at,NULL',
        ]);
        $result = Department::findOrFail($id)->update([
            'name'          => $request->name,
            'status'        => $request->status,
        ]);
        if($result) {
            Flash::success(__('action.updated',['type' => 'Department']));
        }
        return redirect()->route('department.index');
    }
    public function delete($id)
    {
        if(Department::find($id)->delete()) {
            Flash::success(__('action.deleted',['type' => 'Department']));
        }
        return redirect()->route('department.index');
    }
}
