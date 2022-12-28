<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Models\BookHomeCollection;
use App\Models\NewsEvent;
use App\Models\Orders;
use App\Models\Packages;
use App\Models\PaymentConfig;
use App\Models\SubTests;
use App\Models\Tests;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class ApiController extends Controller
{
    public function banners()
    {
        $data = Banners::latest()->get();
        $banner = [];
        foreach($data as $item ) {
            $banner[] = [
                'Title' => $item->Title,
                'Content' => $item->Content,
                'Url' => $item->Url,
                'DesktopImage' => asset_url($item->DesktopImage),
                'MobileImage' => asset_url($item->MobileImage),
                'OrderBy' => $item->OrderBy,
                'Status' => $item->Status
            ];
        }
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
        $file = Storage::put('contact', $request->file('reportFile'));
        BookHomeCollection::create([
            "name" => $request->name,
            "mobile" => $request->mobile,
            "location" => $request->location,
            "file" => $file,
            "test_name" => $request->test_name,
            "comments" => $request->comments,
        ]);
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
                    "data"      =>  $User,
                    "message" => "Login Success !"
                ]);
            } else {
                return response()->json([
                    "status"    =>  false,
                    "message"  =>  'Password or Email id Wrong !'
                ]);
            }
        }
        return response()->json([
            "status"    =>  false,
            "message"      =>  'User Not Found !'
        ]);
    }
    public function register(Request $request)
    {
        $User = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'    => 0,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            "status"    =>  true,
            "data"      =>  $User
        ]);
    }
    public function update_customer(Request $request,$id)
    {
        $customer = User::with('CustomerDetails')->find($id);
        $customer->CustomerDetails()->update($request->all());
        return response()->json([
            "status" => true,
            "message" => 'Your Information Updated !'
        ]);
    }
    public function update_billing_address(Request $request)
    {
        $customerInfo = $request->all();
        unset($customerInfo['amount']);
        $customer = User::with('CustomerDetails')->find($request->id);
        if(!is_null($customer->CustomerDetails() ?? null)) {
            $customer->CustomerDetails()->delete();
        }
        $customer->CustomerDetails()->create($customerInfo);

        $api = new Api(PaymentApiConfig()->payKeyId,PaymentApiConfig()->paySecretKey);
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
            "order_amount" => $request->total_price
        ]);

        $Order->update([
            'order_id' => OrderId($Order->id),
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
        $api    = new Api(PaymentApiConfig()->payKeyId,PaymentApiConfig()->paySecretKey);
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

    public function customer_info($id)
    {
        $customer = User::with('CustomerDetails')->find($id);
        return [
            "status" => true,
            "data" => $customer
        ];
    }
    public function packages(Request $request)
    {
        $Packages =   Packages::with('SubTestList','PackagesPrice')->select('*')->latest();

        foreach ($request->all() as $key => $value) {
            if(!empty($value)) {
                $Packages->where($key,'LIKE',"%$value%");
            }
        }

        return [
            "status" => true,
            "count" => count($Packages->get()),
            "data" => $Packages->get(),
        ];
    }

    public function getOrders($id)
    {
        return [
            "status" => true,
            "data" =>  Orders::with('Tests')->where('user_id',$id)->get()
        ];
    }

    public function change_my_password(Request $request,$id)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword($id)],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);
        User::find($id)->update(['password'=> Hash::make($request->new_password)]);
        return [
            "status" => true,
            "message" =>  "Reset Password Success !"
        ];
    }
}
