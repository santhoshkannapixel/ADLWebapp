<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HospitalLabManagementExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HospitalLabManagement;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class HospitalLabManagementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = HospitalLabManagement::when(!empty($request->start_date) && !empty($request->end_date), function ($query) use ($request) {
                $start_month     = Carbon::parse($request->start_date)->startOfDay();
                $end_month       = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })->orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';

                    if (permission_check('HOSPITAL_LAB_MANAGEMENT_SHOW'))
                    $show =  button('show', route('hospital-lab-management.show', $data->id));

                    if (permission_check('HOSPITAL_LAB_MANAGEMENT_DELETE'))
                    $delete = button('delete', route('hospital-lab-management.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.doctors.hospital-lab-management.index');
    }
    public function destroy($id = null)
    {
        $careers  = HospitalLabManagement::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Hospital Lab Data']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   HospitalLabManagement::findOrFail($id);
        $data   =   HospitalLabManagement::select(DB::raw("hospital_name as hospital_name,hospital_address as hospital_address,name as name,
        mobile as mobile,email as email,designation as designation,message as message,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);

        return view('admin.doctors.hospital-lab-management.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new HospitalLabManagementExport($request), 'hospital_lab_management.xlsx');
    }
}
