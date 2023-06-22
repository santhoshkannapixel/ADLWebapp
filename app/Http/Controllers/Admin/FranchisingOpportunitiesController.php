<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FranchisingOpportunitiesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FranchisingOpportunities;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class FranchisingOpportunitiesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = FranchisingOpportunities::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';

                    if (permission_check('FRANCHISING_OPPORTUNITIES_SHOW'))
                    $show =  button('show', route('franchising-opportunities.show', $data->id));

                    if (permission_check('FRANCHISING_OPPORTUNITIES_DELETE'))
                    $delete = button('delete', route('franchising-opportunities.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.doctors.franchising-opportunities.index');
    }
    public function destroy($id = null)
    {
        $careers  = FranchisingOpportunities::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Hospital Lab Data']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   FranchisingOpportunities::findOrFail($id);
        $data   =   FranchisingOpportunities::select(DB::raw("name as name,city as city,mobile as mobile,email as email,message as message,
        DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);

        return view('admin.doctors.franchising-opportunities.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new FranchisingOpportunitiesExport, 'franchising_opportunities.xlsx');
    }
}
