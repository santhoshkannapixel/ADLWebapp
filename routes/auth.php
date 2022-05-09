<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
 
 
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});
 