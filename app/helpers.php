<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Storage;

if (!function_exists('asset_url')) {
    function asset_url($value)
    {
        if (!is_null($value)) {
            if (Storage::exists($value)) {
                return url('/storage/app/' . $value);
            }
        }
        return asset('public/images/no-image.jpg');
    }
}
if (!function_exists('filedCall')) {
    function filedCall($data)
    {
        return response()->json(['Status'=>200,'Error'=>true,'Message'=>$data]);
    }
}
if (!function_exists('successCall')) {
    function successCall()
    {
        return response()->json(['Status'=>200,'Errors'=>true,'Message'=>'Created Success']);
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
                <a href="' . $url . '" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Edit">
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
            return '<a href="' . $url . '" class="m-1 shadow-sm btn btn-sm text-success btn-outline-light"><i class="fa fa-eye"></i></a>';
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
}
