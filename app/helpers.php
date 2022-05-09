<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Storage;

if(!function_exists('asset_url')) {
    function asset_url($value)
    {
         
        if(!is_null($value)) {
            if(Storage::exists($value)){
                return url('/storage/app/'.$value);
            }
        }
        
        return asset('public/images/no-image.jpg');
    }
}

if(!function_exists('auth_id')) {
    function auth_id()
    {  
        return Sentinel::getUser()->name;
    }
}