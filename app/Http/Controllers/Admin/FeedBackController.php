<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FeedBackExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class FeedBackController extends Controller
{
    public function index(Request $request, $type = 'feedback')
    {
        if ($request->ajax()) {

            $data = FeedBack::where('page_url', 'LIKE', "%/$type")->orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) use ($type) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';

                    if (permission_check('FEEDBACK_SHOW'))
                        $show =  button('show', route('feedback.show', ["type" => $type, "id" =>  $data->id]));

                    if (permission_check('FEEDBACK_DELETE'))
                        $delete = button('delete', route('feedback.delete', ["type" => $type, "id" =>  $data->id]));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.enquiry.feedback.index');
    }
    public function destroy($type, $id = null)
    {
        $careers  = FeedBack::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'FeedBack']));
        return redirect()->back();
    }
    public function show($type, $id)
    {
        // $data   =   FeedBack::findOrFail($id);
        $data   =   FeedBack::select(DB::raw("qa_comments,page_url,name as name,mobile as mobile,email as email,location as location,message as message,
        DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);
        return view('admin.enquiry.feedback.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new FeedBackExport, 'feedback.xlsx');
    }
}
