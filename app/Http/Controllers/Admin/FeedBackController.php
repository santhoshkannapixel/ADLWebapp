<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

class FeedBackController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = FeedBack::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('feedback.show', $data->id));
                    $delete = button('delete', route('feedback.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.enquiry.feedback.index');
    }
    public function destroy($id = null)
    {
        $careers  = FeedBack::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'FeedBack']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   FeedBack::findOrFail($id);
        $data   =   FeedBack::select(DB::raw("name as name,mobile as mobile,email as email,location as location,message as message,
        DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);
        return view('admin.enquiry.feedback.show', compact('data'));
    }
}
