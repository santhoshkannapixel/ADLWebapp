<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class ,'index'])->name('login');
Route::get('/logout', [AuthController::class ,'index'])->name('login');
Route::get('/login', [AuthController::class ,'index'])->name('login');
Route::post('/login', [AuthController::class ,'login'])->name('login');
Route::post('/logout', [AuthController::class ,'logout'])->name('logout');
