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

if(!function_exists('button')) {
    function button($type, $url)
    {  
        if($type == 'edit') {
            return '
                <a href="'.$url.'" class="m-1  shadow btn btn-sm text-primary btn-outline-light" title="Edit"> 
                    <i class="bi bi-pencil"></i>
                </a>
            ';
        }

        if($type == 'delete') {
            return '
                <form method="post" action="'.$url.'" class="d-inline-block"> 
                        '.csrf_field().'
                    <button id="confirmDelete" type="submit" class="m-1 shadow btn btn-sm text-danger btn-outline-light" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            ';
        }

        if($type == 'show') {
            return '<a href="'.$url.'" class="m-1 shadow btn btn-sm text-success btn-outline-light"><i class="fa fa-eye"></i></a>';
        }
    }
}