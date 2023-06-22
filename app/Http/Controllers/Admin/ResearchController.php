<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ResearchExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class ResearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Research::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    if (permission_check('RESEARCH_SHOW'))
                    $show =  button('show', route('research.show', $data->id));

                    if (permission_check('RESEARCH_DELETE'))
                    $delete = button('delete', route('research.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.doctors.research.index');
    }
    public function destroy($id = null)
    {
        $careers  = Research::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   Research::findOrFail($id);
        $data   =   Research::select(DB::raw("name as name,city as city,mobile as mobile,email as email,message as message,
        DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);

        return view('admin.doctors.research.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new ResearchExport, 'research.xlsx');
    }
}
