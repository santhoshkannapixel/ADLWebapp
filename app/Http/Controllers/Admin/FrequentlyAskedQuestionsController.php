<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrequentlyAskedQuestions;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;

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
                    $show =  button('show', route('faq.show', $data->id));
                    $delete = button('delete', route('faq.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
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
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        // $data   =   FrequentlyAskedQuestions::findOrFail($id);
        $data   =   FrequentlyAskedQuestions::select(DB::raw("name as name,mobile as mobile,email as email,location as location,message as 
        message,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date,
        DATE_FORMAT(updated_at,'%d/%m/%Y') as updated_date"))->findOrFail($id);

        return view('admin.enquiry.faq.show', compact('data'));
    }
}
