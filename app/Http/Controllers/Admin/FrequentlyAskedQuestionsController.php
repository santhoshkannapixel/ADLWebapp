<?php

namespace App\Http\Controllers\Admin;

use App\Exports\FrequentlyAskedQuestionsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrequentlyAskedQuestions;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class FrequentlyAskedQuestionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = FrequentlyAskedQuestions::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';

                    if (permission_check('FAQ_SHOW'))
                    $show =  button('show', route('faq.show', $data->id));

                    if (permission_check('FAQ_DELETE'))
                    $delete = button('delete', route('faq.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return dateFormat($data['created_at']);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.enquiry.faq.index');
    }
    public function destroy($id = null)
    {
        $careers  = FrequentlyAskedQuestions::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Frequently Asked Questions']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   FrequentlyAskedQuestions::findOrFail($id);
        $data   =   FrequentlyAskedQuestions::select(DB::raw("name as name,mobile as mobile,email as email,location as location,message as 
        message,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);

        return view('admin.enquiry.faq.show', compact('data'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new FrequentlyAskedQuestionsExport, 'faq.xlsx');
    }
}
