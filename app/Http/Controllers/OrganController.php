<?php

namespace App\Http\Controllers;

use App\Models\Organs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class OrganController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Organs::select('*');
            return DataTables::eloquent($data)->addIndexColumn()
            ->addColumn('image', function ($data) {
                return '
                    <img src="'.asset_url($data->image).'" height="40"/>
                ';
            })   
            ->addColumn('action', function ($data) {
                return button('edit',route('organ.edit', $data->id)).button('delete',route('organ.destroy', $data->id));
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        return view('admin.master.organs.index');
    }
    public function create()
    {
        return view('admin.master.organs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'order_by' => 'required',
        ]);
        Organs::create([
            "name" => $request->name,
            "image" => Storage::put('public/files/organs',$request->image),
            "order_by" => $request->order_by,
        ]);
        Flash::success(__('action.created',['type' => 'Organ']));
        return redirect(route('organ.index'));
    }
    public function edit($id)
    {
        $organ = Organs::findOrFail($id);
        return view('admin.master.organs.edit',compact('organ'));
    }
    public function update(Request $request,$id)
    {
        $Organs = Organs::findOrFail($id);
 
        if($request->image) {
            if(Storage::exists($Organs->image)){
                Storage::delete($Organs->image);
            }
            $Organs->update([
                "image" => Storage::put('public/files/organs',$request->image),
            ]);
        }

        $Organs->update([
            "name" => $request->name,
            "order_by" => $request->order_by,
        ]);

        Flash::success(__('action.updated',['type' => 'Organ']));

        return redirect(route('organ.index'));
    }

    public function destroy($id = null)
    {
        $Organ  = Organs::find($id);
        if(Storage::exists($Organ->image)){
            Storage::delete($Organ->image);
        } 
        $Organ->delete();
        Flash::success( __('action.deleted', ['type' => 'Organ']));
        return redirect()->back();
    }
}
