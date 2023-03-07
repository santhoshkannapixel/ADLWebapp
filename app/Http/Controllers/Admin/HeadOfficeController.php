<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HeadOfficeExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeadOffice;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class HeadOfficeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = HeadOffice::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('healthcheckup-for-employee.show', $data->id));
                    $delete = button('delete', route('healthcheckup-for-employee.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reach-us.head-office.index');
    }
    public function destroy($id = null)
    {
        $careers  = HeadOffice::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   HeadOffice::findOrFail($id);
        $data   =   HeadOffice::select(DB::raw("name as name,company_name as company_name,mobile as mobile,email as email,designation as 
        designation,message as message,address as address,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);

        return view('admin.reach-us.head-office.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new HeadOfficeExport, 'head_office.xlsx');

    }
}
