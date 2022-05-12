<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApiConfigController;
use App\Http\Controllers\Admin\PaymentConfigController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
 

Route::middleware(['auth_users'])->group(function () {

    Route::group(['prefix' => 'admin'], function(){
 
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
         
        // User Routes 
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user-delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user-update/{id}', function () {   
            return redirect()->back();
        })->name('user.update');

        
        Route::get('/api-config', [ApiConfigController::class, 'index'])->name('api_config.index');
        Route::get('/api-config/create', [ApiConfigController::class, 'create'])->name('api_config.create');
        Route::get('/api-config/{id}', [ApiConfigController::class, 'edit'])->name('api_config.edit');
        Route::post('/api-config/{id?}', [ApiConfigController::class, 'updateOrCreate'])->name('api_config.store');
        Route::post('/api-config-delete/{id}', [ApiConfigController::class, 'destroy'])->name('api_config.delete');

        Route::get('/payment-config', [PaymentConfigController::class, 'index'])->name('payment_config.index');
        Route::get('/payment-config/create', [PaymentConfigController::class, 'create'])->name('payment_config.create');
        Route::get('/payment-config/{id}', [PaymentConfigController::class, 'edit'])->name('payment_config.edit');
        Route::post('/payment-config/{id?}', [PaymentConfigController::class, 'updateOrCreate'])->name('payment_config.store');
        Route::post('/payment-config-delete/{id}', [PaymentConfigController::class, 'destroy'])->name('payment_config.delete');



         // Role Routes 
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role-delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
        Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role-update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/role-update/{id}', function () {   
            return redirect()->back();
        })->name('role.update');

        // Master 
        Route::get('master/branch', [BranchController::class, 'index'])->name('master.index');
        
        // Branch  Master
        Route::post('master/branch', [BranchController::class, 'syncRequest'])->name('branch.sync');
        Route::get('master/branch/{id}', [BranchController::class, 'show'])->name('branch.show'); 

        // City Master
        Route::get('master/city', [CityController::class, 'index'])->name('city.index');
        Route::post('master/city', [CityController::class, 'syncRequest'])->name('city.sync');

        // Test Master
        Route::get('master/test', [TestController::class, 'index'])->name('test.index');
        Route::get('master/test/{id}', [TestController::class, 'show'])->name('test.show');
        Route::get('master/test/edit/{id}', [TestController::class, 'edit'])->name('test.edit');
        Route::post('master/test/edit/{id}', [TestController::class, 'update'])->name('test.edit');
        Route::post('master/test', [TestController::class, 'syncRequest'])->name('test.sync');

        // Banner Master
        Route::get('master/banner', [BannerController::class, 'index'])->name('banner.index');
        Route::get('master/banner/create', [BannerController::class, 'create'])->name('banner.create');
        Route::get('master/banner/{id}', [BannerController::class, 'edit'])->name('banner.edit'); 
        Route::post('master/banner/{id?}', [BannerController::class, 'store'])->name('banner.store');
        Route::post('master/banner/delete/{id?}', [BannerController::class, 'delete'])->name('banner.delete'); 
    }); 
});