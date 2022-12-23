<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\NewsEvent;
use App\Models\Orders;
use App\Models\PaymentConfig;
use App\Models\SubTests;
use App\Models\Tests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class ApiController extends Controller
{
    public function banners()
    {
        $data = Banners::latest()->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
    public function topBookedTest()
    {
        $data   = Tests::oldest()->limit(10)->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
    public function testDetails($id)
    {
        $data    = Tests::find($id);
        $subData = SubTests::where("TestId", $data->id)->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  [
                "test"      => $data,
                "sub_test"  => $subData,
            ]
        ]);
    }
    public function bannerContactForm(Request $request)
    {
        Storage::put('contact', $request->file('reportFile'));
        return response()->json([
            "status"    =>  true,
            "message"   =>  "Form Submit Success !"
        ]);
    }
    public function testLists(Request $request,$type=null)
    {
        if(is_null($type)) {
            $IsPackage = 'No';
        } else {
            $IsPackage = 'Yes';
        }
        $data   =   Tests::with('SubTestList')
                            ->where('TestName', 'like', '%'.$request->search.'%')
                            ->where('IsPackage', $IsPackage)
                            ->skip(0)
                            ->take($request->tack)
                            ->orderBy('TestPrice', ($request->sort == 'low' ? "DESC" : null) === null ? "DESC" : 'ASC'  )
                            ->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $data
        ]);
    }
    public function newsAndEvents()
    {
        return response()->json([
            "status"    =>  true,
            "data"      =>  NewsEvent::all()
        ]);
    }
    public function login(Request $request)
    {
        $User = User::where('email',$request->email)->first();
        if(!is_null($User)) {
            if(Hash::check($request->password, $User->password)){
                return response()->json([
                    "status"    =>  true,
                    "data"      =>  $User
                ]);
            } else {
                return response()->json([
                    "status"    =>  false,
                    "data"      =>  'Password or Email id Wrong !'
                ]);
            }
        }
        return response()->json([
            "status"    =>  false,
            "data"      =>  'User Not Found !'
        ]);
    }
    public function register(Request $request)
    {
        $User = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            "status"    =>  true,
            "data"      =>  $User
        ]);
    }
    public function update_billing_address(Request $request)
    {
        $customerInfo = $request->all();
        unset($customerInfo['amount']);
        $customer = User::with('CustomerDetails')->find($request->id);
        $customer->CustomerDetails()->delete();
        $customer->CustomerDetails()->create($customerInfo);

        $api = new Api(config('payment.KeyID'), config('payment.KeySecret'));
        $Order = $api->order->create([
            'amount'   => (int) $request->amount * 100,
            'currency' => 'INR'
        ]);

        return response([
            "status" => true,
            "data" => [
                "key" => PaymentConfig::where('gateWayName','RAZOR_PAY')->first()->payKeyId ?? config('payment.KeyID'),
                "title" => "Pay Online",
                "image" => asset('/public/images/logo/favicon.png'),
                "name" => $customer->name,
                "email" => $customer->email,
                "contact" => $customer->CustomerDetails['phone_number'] ?? null,
                "order_id" => $Order['id'],
                "user" => $customer
            ]
        ]);
    }

    public function save_payment_order(Request $request)
    {
        $result =  $this->CheckValidOrder($request->razorpay_response);

        if($result['status'] == false) {
            $message = "Payment Failed";
            $status = 0;
        } else {
            $message = "Payment Success";
            $status = 1;
        }

        $Order = Orders::create([
            'payment_id' => $result['payment_id'],
            'razorpay_order_id' => $result['order_id'],
            'user_id' => $request->user['id'],
            'appoinment' => $request->appoinment,
            'datetime' => $request->datetime,
            'payment_status' => $status,
            "order_response"    =>  $result['order_response'],
        ]);
        if(count($request->products)) {
            foreach ($request->products as $key => $product) {
                $Order->Tests()->create($product);
            }
        }
        return response()->json([
            "status" => $result['status'],
            "message" => $message
        ]);
    }

    public function CheckValidOrder($response)
    {
        $api    = new Api(config('payment.KeyID'), config('payment.KeySecret'));
        if($response['status'] == 'PAID') {
            $order_response = $api->order->fetch($response['data']['razorpay_order_id']);
            $payment_id =   $response['data']['razorpay_payment_id'];
            $order_id   =   $response['data']['razorpay_order_id'];
            if( isset($order_response['status']) && $order_response['status'] == 'paid' ) {
                $status = true;
            }
            try {
                $api->utility->verifyPaymentSignature([
                    'razorpay_order_id' => $order_id,
                    'razorpay_payment_id' => $payment_id,
                    'razorpay_signature' => $response['data']['razorpay_signature']
                ]);
            } catch(SignatureVerificationError $e) {
                $error = 'Razorpay Error : ' . $e->getMessage();
                $status = false;
            }
        } else {
            if(isset($response['data']['error'])) {
                $payment_id =   $response['data']['error']['metadata']['payment_id'];
                $order_id   =   $response['data']['error']['metadata']['order_id'];
                $order_response =   $api->order->fetch($order_id);
                $status = false;
            }
        }

        return [
            "status" => $status,
            "payment_id" => $payment_id,
            "order_id" => $order_id,
            "order_response" => serialize($order_response)
        ];
    }
}
