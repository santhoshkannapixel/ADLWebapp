<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function banners()
    {
        $banners = Banners::latest()->get();
        return response()->json([
            "status"    =>  true,
            "data"      =>  $banners
        ]);
    }
}