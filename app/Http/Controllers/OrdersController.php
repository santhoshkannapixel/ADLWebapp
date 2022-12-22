<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Orders::with('User','Tests')->select('*');
            return DataTables::eloquent($data)->addIndexColumn()
                ->addColumn('customer',function ($data) {
                    return $data->User->name;
                })
                ->addColumn('appoinment',function ($data) {
                    return $data->appoinment == 1 ? 'Yes' : 'No';
                })
                ->addColumn('datetime',function ($data) {
                    return Carbon::parse($data->datetime)->format('d-m-Y H:i A');
                })
                ->addColumn('status',function ($data) {
                    if($data->status == 1) {
                        return '<span class="btn-sm bg-success text-white rounded">
                            <span class="fa fa-check-circle me-1"></span> Success
                        </span>';
                    }
                    return '<span class="btn-sm bg-danger text-white rounded">
                        <span class="fa fa-check-ban me-1"></span> Failed
                    </span>';
                })
                ->addColumn('action', function ($data) {
                    return button('show',route('orders.show', $data->id));
                })
                ->rawColumns(['customer','action','status'])
                ->make(true);
        }
        return view('admin.orders.index');
    }

    public function show($id)
    {
        $order = Orders::with('User','Tests','Customer')->find($id);
        return view('admin.orders.show',compact('order'));
    }
}
