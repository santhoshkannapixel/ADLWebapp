<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HospitalLabManagement;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class HospitalLabManagementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = HospitalLabManagement::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('hospital-lab-management.show', $data->id));
                    $delete = button('delete', route('hospital-lab-management.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
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
}
