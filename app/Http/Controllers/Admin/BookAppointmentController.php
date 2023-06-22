<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookAppointmentExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class BookAppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BookAppointment::with(['location','test'])->when(!empty($request->start_date) && !empty($request->end_date), function ($query) use ($request) {
                $start_month     = Carbon::parse($request->start_date)->startOfDay();
                $end_month       = Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })->orderBy('id', 'DESC');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('download', function ($data) {
                    if(!empty($data->file ))
                    {
                    return '<a href="' . url('/storage/app/') .'/' . $data->file . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                    <i class="bi bi-download"></i>
                    </a>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';

                    if (permission_check('BOOK_AN_APPOINTMENT_SHOW'))
                    $show =  button('show', route('book-an-appointment.show', $data->id));

                    if (permission_check('BOOK_AN_APPOINTMENT_DELETE'))
                    $delete = button('delete', route('book-an-appointment.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action', 'download'])
                ->make(true);
        }
        return view('admin.health-checkup.book-an-appointment.index');
    }
    public function destroy($id = null)
    {
        $careers  = BookAppointment::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   BookAppointment::findOrFail($id);
        $data   =   BookAppointment::select(DB::raw("book_appointments.name as name,book_appointments.mobile as mobile,
        book_appointments.file as file,
        book_appointments.test_id as test_name,book_appointments.test_type as test_type,cities.AreaName as area_name,tests.TestName as test_name,DATE_FORMAT(book_appointments.created_at,'%d/%m/%Y') as created_date"))
        ->join('cities','cities.AreaId','=','book_appointments.location_id')
        ->join('tests','tests.id','=','book_appointments.test_id')
        ->findOrFail($id);
        return view('admin.health-checkup.book-an-appointment.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new BookAppointmentExport($request), 'book_appointment.xlsx');
    }
}
