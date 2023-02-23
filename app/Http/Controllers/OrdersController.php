<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetails;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) { 
            $data = Orders::with('User','User.CustomerDetails','Tests')->select('*');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('created_at',function ($data) {
                    return dateFormat($data->created_at);
                })
                ->addColumn('id',function ($data) {
                    return OrderId($data->id);
                })
                ->addColumn('customer',function ($data) {
                    return $data->User->name ?? "";
                })
                ->addColumn('phone_number',function ($data) {
                    return $data->User->CustomerDetails->phone_number;
                })
                ->addColumn('email',function ($data) {
                    return $data->User->CustomerDetails->email;
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
                    return OrderStatus($data->order_status);
                })
                ->addColumn('action', function ($data) {
                    return button('show',route('orders.show', $data->id)).button('phone',$data->User->CustomerDetails->phone_number).button('email',$data->User->CustomerDetails->email);
                })
                ->rawColumns(['customer','action','payment_status','order_status'])
                ->make(true);
        }
        return view('admin.orders.index');
    }

    public function show($id)
    {
        $order = Orders::with('User','Tests')->find($id);
        $customer = CustomerDetails::where('user_id', $order->User->id)->first();
        return view('admin.orders.show',compact('order','customer'));
    }

    public function change_order_status(Request $request ,$id)
    {
        $result = Orders::findOrFail($id)->update(['order_status' => $request->order_status]);
        if($result) {
            Flash::success('Order Status Changed !');
        }
        return back();
    }
}
