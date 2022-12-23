<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = User::with('CustomerDetails')->where('role_id',0)->select('*');
            return DataTables::eloquent($data)->addIndexColumn()
                ->addColumn('phone_number', function ($data) {
                    return $data->CustomerDetails->phone_number ?? null;
                })
                ->addColumn('action', function ($data) {
                    return button('show',route('orders.show', $data->id));
                })
                ->make(true);
        }
        return view('admin.customers.index');
    }
}
