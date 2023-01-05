<?php

use App\Models\ApiConfig;
use App\Models\PaymentConfig;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Storage;
use Razorpay\Api\Api;

if (!function_exists('auth_user_role')) {
    function auth_user_role()
    {
        return Sentinel::getUser()->roles[0];
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        return Sentinel::getUser();
    }
}


if (!function_exists('fetchOrder')) {
    function fetchOrder($id)
    {
        $api = new Api(config('payment.KeyID'), config('payment.KeySecret'));
        return  $api->order->fetch($id);
    }
}

if (!function_exists('OrderId')) {
    function OrderId($id)
    {
        $prefix = 'ADL/'.date("Y").'/';
        if (strlen($id) == 1) {
            return  $prefix . "0000" . $id;
        }
        if (strlen($id) == 2) {
            return  $prefix . "000" . $id;
        }
        if (strlen($id) == 3) {
            return  $prefix . "00" . $id;
        }
        return  $prefix . "0" . $id;
    }
}
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return Carbon::parse($date)->format('d-m-Y');
    }
}

if (!function_exists('textFormat')) {
    function textFormat($text)
    {
        return ucfirst(str_replace('_', ' ', $text));
    }
}
if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i A');
    }
}
if (!function_exists('asset_url')) {
    function asset_url($value)
    {
        if (!is_null($value)) {
            if (Storage::exists($value)) {
                return url('/storage/app/' . $value);
            }
        }
        if(str_contains($value,'http')) {
            return $value;
        }
        return asset('public/images/no-image.jpg');
    }
}
if (!function_exists('filedCall')) {
    function filedCall($data)
    {
        return response()->json(['Status' => 200, 'Error' => true, 'Message' => $data]);
    }
}
if (!function_exists('successCall')) {
    function successCall()
    {
        return response()->json(['Status' => 200, 'Errors' => false, 'Message' => 'Created Successfully']);
    }
}

if (!function_exists('auth_id')) {
    function auth_id()
    {
        return Sentinel::getUser()->name;
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        return Sentinel::getUser();
    }
}

if (!function_exists('button')) {
    function button($type, $url)
    {
        if ($type == 'edit') {
            return '
                <a href="' . $url . '" title="' . $url . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
            ';
        }

        if ($type == 'delete') {
            return '
                <form method="post" action="' . $url . '" class="d-inline-block">
                        ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button id="confirmDelete" type="submit" class="m-1 shadow-sm btn btn-sm text-danger btn-outline-light" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            ';
        }

        if ($type == 'show') {
            return '<a href="' . $url . '" title="' . $url . '" class="m-1 shadow-sm btn btn-sm text-success btn-outline-light"><i class="fa fa-eye"></i></a>';
        }
        if ($type == 'phone') {
            return '<a href="tel:' . $url . '" title="' . $url . '" class="m-1 shadow-sm btn btn-sm text-primary btn-outline-light"><i class="fa fa-phone"></i></a>';
        }
        if ($type == 'email') { 
            return '<a  href="mailto:'.$url.'" title="' . $url . '" class="m-1 shadow-sm btn btn-sm text-warning btn-outline-light"><i class="fa fa-envelope"></i></a>';
        }
    }
}
if (!function_exists('toggleButton')) {
    function toggleButton($type, $url, $data)
    {
        if ($type == 'status') {
            if ($data->status == '1') {
                $checked = 'checked="checked"';
            } else {

                $checked = '';
            }
            return '<label class="switch">
            <input data-id="' . $url . '" type="checkbox" id="status"  onclick="statuschange(' . $data->status . ',' . $data->id . ')"  ' . $checked . '>
            <div class="slider round"></div>
            </label>';
        }
    }

    if(!function_exists('getApiMaster')) {
        function getApiMaster($type) {
            $data = ApiConfig::where('apiType', (string) $type)->get()->toArray();
            $result = [];
            if(!is_null($data)) {
                foreach($data as $api) {
                    $result[] = [
                        "location" =>  $api['location_slug'],
                        "http" => $api['apiUrl']."?CorporateID=".$api['corporateID']."&passCode=".$api['passCode']
                    ];
                }
            }
            return $result;
        }
    }

    if(!function_exists('PaymentApiConfig')) {
        function PaymentApiConfig() {
            return PaymentConfig::find(1);
        }
    }
    if(!function_exists('breadcrumbTitle')) {
        function breadcrumbTitle() {
            $text = request()->route()->getName();
            $result =  ucfirst(str_replace(['.','-','_'],' ',$text));
            return str_replace('show', 'Detail view', str_replace('index','',$result));
        }
    }

    if(!function_exists('OrderStatus')) {
        function OrderStatus($status) {
            if($status == null || $status == "0") {
                return '<span class="badge-secondary"><span class="fa fa-clock-o me-1"></span> Pending</span>';
            }
            if($status == "1") {
                return '<span class="badge-success"><span class="fa fa-check me-1"></span> Accepted</span>';
            }
            if($status == "2") {
                return '<span class="badge-danger"><span class="fa fa-ban me-1"></span> Denied</span>';
            }
            if($status == "3") {
                return '<span class="badge-warning"><span class="fa fa-ban me-1"></span> Cancel Requested</span>';
            }
            if($status == "4") {
                return '<span class="badge-warning"><span class="fa fa-times-circle me-1"></span> Order Cancelled </span>';
            }
            if($status == "5") {
                return '<span class="badge-danger"><span class="fa fa-ban me-1"></span> Cancel Request Dined</span>';
            }
        }
    }
}