<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentConfig;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PaymentConfigController extends Controller
{ 
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $data = PaymentConfig::all();
            return datatables()->of($data)
            ->addColumn('action', function($data){
                $action = button('edit',route('payment_config.edit', $data->id)).button('delete',route('payment_config.delete', $data->id)); 
                return $action;
            })
            ->rawColumns(array(
                'action'
            ))
            ->addIndexColumn()->make(true);
        }
        return view('admin.settings.payment-config.index');
    }

    public function create()
    {
        return view('admin.settings.payment-config.create');
    }

    public function updateOrCreate(Request $request , $id = null)
    {
  
        PaymentConfig::updateOrCreate(["id" => $id], [
            'gateWayName'   => $request->gateWayName,
            'payKeyId'      => $request->payKeyId,
            'paySecretKey'  => $request->paySecretKey,
        ]);

        Flash::success( __('action.saved', ['type' => 'Payment Config']));

        return redirect()->route('payment_config.index');
    }

    public function edit($id)
    {
        $paymentConfig  = PaymentConfig::findOrFail($id);
        return view('admin.settings.payment-config.edit',compact('paymentConfig'));
    }
    public function destroy($id)
    {
        $paymentConfig  = PaymentConfig::findOrFail($id);
        $paymentConfig->delete();

        Flash::success( __('action.deleted', ['type' => 'Payment Config']));
        return redirect()->route('payment_config.index');
    }
}
