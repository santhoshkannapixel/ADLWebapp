<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientsConsumers;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class PatientsConsumersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = PatientsConsumers::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('patients-consumers.show', $data->id));
                    $delete = button('delete', route('patients-consumers.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.enquiry.patients-consumers.index');
    }
    public function destroy($id = null)
    {
        $careers  = PatientsConsumers::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   PatientsConsumers::findOrFail($id);
        $data   =   PatientsConsumers::select(DB::raw("name as name,mobile as mobile,email as email,date as date,gender as gender,test_for_home_collection as test_for_home_collection,upload_prescription as upload_prescription,preferred_date_1 as preferred_date_1,preferred_date_2 as preferred_date_2,preferred_time as preferred_time,address as address,pincode as pincode,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date,DATE_FORMAT(updated_at,'%d/%m/%Y') as updated_date,DATE_FORMAT(deleted_at,'%d/%m/%Y') as deleted_date"))->findOrFail($id);

        return view('admin.enquiry.patients-consumers.show', compact('data'));
    }
}
