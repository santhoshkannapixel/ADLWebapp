<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CareerExport;
use App\Exports\HeadOfficeExport;
use App\Http\Controllers\Controller;
use App\Models\Career;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Career::with('job')
            ->when(!empty($request->start_date) && !empty($request->end_date), function ($query) use ($request) {
                $start_month     = Carbon::parse($request->start_date)->startOfDay();
                $end_month       = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })->orderBy('careers.created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('download', function ($data) {
                    return '<a href="' . url('/') . '/storage/app/' . $data->file . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                    <i class="bi bi-download"></i>
                    </a>';
                })
                ->addColumn('action', function ($data) {
                    $delete = '';
                    $view = '';

                    if (permission_check('CAREERS_DELETE'))
                    $delete = button('delete', route('careers.delete', $data->id));


                    if (permission_check('CAREERS_VIEW'))
                    $view = button('show', route('careers.view', $data->id));
                    return $view.$delete;
                })
                
                ->editColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })
            
                ->rawColumns(['action', 'download'])
                ->make(true);
        }
        return view('admin.manage_career.careers.index');
        
      
    }
    public function delete($id = null)
    {
        $careers  = Career::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Career']));
        return redirect()->back();
    }
    public function view($id)
    {
        $data = Career::where('id',$id)->with('job')->first();
        return view('admin.manage_career.careers.view',compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new CareerExport($request), 'career.xlsx');
    }
}
