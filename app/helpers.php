<?php

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