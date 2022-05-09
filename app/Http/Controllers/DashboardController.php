<?php

namespace App\Http\Controllers;

use App\Models\Enquiries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            
            if(!empty($request->from_date))      {
                $data = Enquiries::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }   else   {
                $data = Enquiries::all();
            }

            return datatables()->of($data)->addIndexColumn()->make(true);
        }
        return view('admin.index');
    }
}