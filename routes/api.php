<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
 
Route::get('banners', [ApiController::class,'banners']);