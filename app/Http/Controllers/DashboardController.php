<?php

namespace App\Http\Controllers;

use App\Models\Enquiries;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Enquiries::select([
                'id',
                "Name",
                "Email",
                "Mobile",
                "Address",
                "EnquiryType",
                "EnquiryStatus",
                "created_at",
            ]);
            return DataTables::eloquent($data)->addIndexColumn()->make(true);
        }
        return view('admin.index');  
    }
}
