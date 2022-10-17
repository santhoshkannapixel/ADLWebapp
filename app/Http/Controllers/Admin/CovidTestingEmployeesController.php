<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CovidTestingEmployees;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CovidTestingEmployeesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = CovidTestingEmployees::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('covidtesting-employees.show', $data->id));
                    $delete = button('delete', route('covidtesting-employees.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reach-us.covidtesting-employees.index');
    }
    public function destroy($id = null)
    {
        $careers  = CovidTestingEmployees::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   CovidTestingEmployees::findOrFail($id);
        $data   =   CovidTestingEmployees::select(DB::raw("customer_name as customer_name,company_name as company_name,pincode as pincode,state as state,city as city,number_of_employees as number_of_employees,how_can_we_help_you as how_can_we_help_you,comments as comments,mobile as mobile,email as email,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date,DATE_FORMAT(updated_at,'%d/%m/%Y') as updated_date,DATE_FORMAT(deleted_at,'%d/%m/%Y') as deleted_date"))->findOrFail($id);

        return view('admin.reach-us.covidtesting-employees.show', compact('data'));
    }
}
