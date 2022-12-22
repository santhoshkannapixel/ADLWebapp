<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetails;
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
                ->addColumn('payment_status',function ($data) {
                    if($data->payment_status == 1) {
                        return '<span class="badge-success"><span class="fa fa-check-circle me-1"></span> Paid</span>';
                    }
                    return '<span class="badge-danger"><span class="fa fa-ban me-1"></span> Failed</span>';
                })
                ->addColumn('order_status',function ($data) {
                    if($data->order_status == null) {
                        return '<span class="badge-secondary"><span class="fa fa-clock-o me-1"></span> Pending</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    return button('show',route('orders.show', $data->id));
                })
                ->rawColumns(['customer','action','payment_status','order_status'])
                ->make(true);
        }
        return view('admin.orders.index');
    }

    public function show($id)
    {
        $order = Orders::with('User','Tests')->find($id);
        $customer = CustomerDetails::where('user_id', 1)->first();
        return view('admin.orders.show',compact('order','customer'));
    }
}
