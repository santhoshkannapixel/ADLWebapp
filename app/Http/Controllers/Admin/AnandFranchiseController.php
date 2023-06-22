<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnandFranchise;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AnandFranchiseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = AnandFranchise::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('anandlab-franchise.show', $data->id));
                    $delete = button('delete', route('anandlab-franchise.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reach-us.anandlab-franchise.index');
    }
    public function destroy($id = null)
    {
        $careers  = AnandFranchise::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   AnandFranchise::findOrFail($id);
        $data   =   AnandFranchise::select(DB::raw("name as name,address as address,pincode as pincode,state as state,city as city,ownership as ownership,profession as profession,association_with_LPL as association_with_LPL,mobile as mobile,email as email,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date,DATE_FORMAT(updated_at,'%d/%m/%Y') as updated_date,DATE_FORMAT(deleted_at,'%d/%m/%Y') as deleted_date"))->findOrFail($id);

        return view('admin.reach-us.anandlab-franchise.show', compact('data'));
    }
}
