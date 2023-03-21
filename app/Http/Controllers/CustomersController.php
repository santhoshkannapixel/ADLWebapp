<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = User::with('CustomerDetails')->where('role_id',0)->select('*')->orderBy('id','desc');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('phone_number', function ($data) {
                    return $data->CustomerDetails->phone_number ?? null;
                })
                ->addColumn('action', function ($data) {
                    if (permission_check('CUSTOMERS_SHOW'))
                    return button('show',route('customers.show',$data->id));
                })
                ->make(true);
        }
            return view('admin.customers.index');
    }
    public function show($id)
    {
        $customer = User::with('CustomerDetails')->where('role_id',0)->where('id',$id)->first();
        return view('admin.customers.show',compact('customer'));
    }
    public function exportData(Request $request)
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }
}
