<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookHomeCollection;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Carbon\Carbon;

class BookHomeCollectionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = BookHomeCollection::orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('download', function ($data) {
                    if(!empty($data->file ))
                    {
                        return '<a href="' . asset_url($data->file) . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                        <i class="bi bi-download"></i>
                        </a>';
                    }
                   
                })
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $show = '';
                    $delete = '';
                    $show =  button('show', route('home-collection.show', $data->id));
                    $delete = button('delete', route('home-collection.delete', $data->id));

                    return $show . $delete;
                })

                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })

                ->rawColumns(['action', 'download'])
                ->make(true);
        }
        return view('admin.enquiry.home-collection.index');
    }
    public function destroy($id)
    {
        $careers  = BookHomeCollection::find($id);
        $careers->delete();
        Flash::success(__('action.deleted', ['type' => 'Home Collection']));
        return redirect()->back();
    }
    public function show($id)
    {
        $data   =   BookHomeCollection::select(DB::raw("name as name,mobile as mobile,location as location,file as file,
        test_name as test_name,comments as comments,DATE_FORMAT(created_at,'%d/%m/%Y') as created_date"))->findOrFail($id);
        return view('admin.enquiry.home-collection.show', compact('data'));
    }
}
