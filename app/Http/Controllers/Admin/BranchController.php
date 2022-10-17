<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
 

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Branch::select([
                "id",
                "BranchCode",
                "BranchName",
                "BranchCity",
                "BrachContact",
                "BranchEmail",
                "IsProcessingLocation",
                "State",
                "Pincode",           
            ]);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('processing', function ($data) {
                    $flag    =  $data->IsProcessingLocation == 'No' ? 'danger' : 'success';
                    $type    =  $data->IsProcessingLocation == 'No' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                })
                
                ->addColumn('action', function ($data) { 
                    return button('show',route('branch.show', $data->id));
                })
            ->rawColumns(['action','processing'])
            ->make(true);
        }
        $last_sync  =   Carbon::parse(Branch::latest()->first()->created_at ?? "")->format('d/m/Y');
        return view('admin.master.branch.index',compact('last_sync'));
    }

    public function syncRequest()
    {
        $response      = Http::get(config('auth.GetBranchMasterBangaloreAPI'));
        $response_data = json_decode($response->body())[0]->Data;

        foreach ($response_data as $data) {
            Branch::updateOrCreate([
                "BranchId"              =>  $data->BranchId  ?? null,
                "BranchCode"            =>  $data->BranchCode  ?? null,
                "BranchName"            =>  $data->BranchName  ?? null,
                "BranchCityId"          =>  $data->BranchCityId  ?? null,
                "BranchCity"            =>  $data->BranchCity  ?? null,
                "BranchAddress"         =>  $data->BranchAddress  ?? null,
                "BrachContact"          =>  $data->BrachContact  ?? null,
                "BranchEmail"           =>  $data->BranchEmail  ?? null,
                "IsProcessingLocation"  =>  $data->IsProcessingLocation  ?? null,
                "BranchTimings"         =>  $data->BranchTimings  ?? null,
                "State"                 =>  $data->State  ?? null,
                "Pincode"               =>  $data->Pincode ?? null,
                "Country"               =>  "India"
            ]);
        }

        Flash::success( __('masters.sync_success'));

        return redirect()->back();
    } 

    public function show($id)
    {
        $data   =   Branch::findOrFail($id);
        
        return view('admin.master.branch.show',compact('data'));
    }
}
