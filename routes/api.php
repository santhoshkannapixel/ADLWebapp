<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
 
Route::get('banners', [ApiController::class,'banners']);
Route::get('topBookedTest', [ApiController::class,'topBookedTest']);
Route::get('test/{id}', [ApiController::class,'testDetails']);
Route::post('test-list', [ApiController::class,'testLists']);

Route::post('bannerContactForm', [ApiController::class,'bannerContactForm']);