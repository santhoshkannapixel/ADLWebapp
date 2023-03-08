<?php

namespace App\Http\Controllers;

use App\Models\Conditions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class ConditionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Conditions::select('*');
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('image', function ($data) {
                return '
                    <img src="'.asset_url($data->image).'" height="40"/>
                ';
            })   
            ->addColumn('action', function ($data) {
                $edit = '';
                $delete = '';

                if (permission_check('CONDITION_EDIT'))
                $edit = button('edit',route('condition.edit', $data->id));

                if (permission_check('CONDITION_DESTROY'))
                $delete = button('delete',route('condition.destroy', $data->id));

                return $edit.$delete;
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        return view('admin.master.conditions.index');
    }
    public function create()
    {
        return view('admin.master.conditions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'order_by' => 'required',
        ]);
        Conditions::create([
            "name" => $request->name,
            "image" => Storage::put('public/files/Conditions',$request->image),
            "order_by" => $request->order_by,
        ]);
        Flash::success(__('action.created',['type' => 'condition']));
        return redirect(route('condition.index'));
    }
    public function edit($id)
    {
        $condition = Conditions::findOrFail($id);
        return view('admin.master.conditions.edit',compact('condition'));
    }
    public function update(Request $request,$id)
    {
        $Conditions = Conditions::findOrFail($id);
 
        if($request->image) {
            if(Storage::exists($Conditions->image)){
                Storage::delete($Conditions->image);
            }
            $Conditions->update([
                "image" => Storage::put('public/files/Conditions',$request->image),
            ]);
        }

        $Conditions->update([
            "name" => $request->name,
            "order_by" => $request->order_by,
        ]);

        Flash::success(__('action.updated',['type' => 'condition']));

        return redirect(route('condition.index'));
    }

    public function destroy($id = null)
    {
        $condition  = Conditions::find($id);
        if(Storage::exists($condition->image)){
            Storage::delete($condition->image);
        } 
        $condition->delete();
        Flash::success( __('action.deleted', ['type' => 'condition']));
        return redirect()->back();
    }
}
