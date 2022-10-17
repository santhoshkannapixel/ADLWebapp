<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class BookAppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BookAppointment::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('download', function ($data) {
                    return '<a href="' . url('/public') . '/admin/book_an_appointment/' . $data->file . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                    <i class="bi bi-download"></i>
                    </a>';
                })
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('book-an-appointment.show', $data->id));
                    $delete = button('delete', route('book-an-appointment.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
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
        $data   =   BookAppointment::select(DB::raw("name as name,location as location,mobile as mobile,file as file,test_name as test_name,test_type as test_type,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date,DATE_FORMAT(updated_at,'%d/%m/%Y') as updated_date,DATE_FORMAT(deleted_at,'%d/%m/%Y') as deleted_date"))->findOrFail($id);

        return view('admin.health-checkup.book-an-appointment.show', compact('data'));
    }
}
