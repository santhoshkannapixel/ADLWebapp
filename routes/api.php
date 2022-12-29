<?php

use App\Http\Controllers\Website\BookAppointmentController;
use App\Http\Controllers\Website\ClinicalLabManagementController;
use App\Http\Controllers\Website\FeedBackController;
use App\Http\Controllers\Website\FranchisingOpportunitiesController;
use App\Http\Controllers\Website\FrequentlyAskedQuestionsController;
use App\Http\Controllers\Website\HeadOfficeController;
use App\Http\Controllers\Website\HospitalLabManagementController;
use App\Http\Controllers\Website\NewsLetterController;
use App\Http\Controllers\Website\PatientsConsumersController;
use App\Http\Controllers\Website\ResearchController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('banners', [ApiController::class,'banners']);
Route::get('topBookedTest', [ApiController::class,'topBookedTest']);
Route::get('test/{id}', [ApiController::class,'testDetails']);
Route::post('test-list/{type?}', [ApiController::class,'testLists']);
Route::post('bannerContactForm', [ApiController::class,'bannerContactForm']);
Route::post('newsAndEvents', [ApiController::class,'newsAndEvents']);
Route::post('login', [ApiController::class,'login']);
Route::post('register', [ApiController::class,'register']);
Route::get('create-order', [ApiController::class,'createOrder']);
Route::get('get-orders/{id}', [ApiController::class,'getOrders']);
Route::post('update-billing-details', [ApiController::class,'update_billing_address']);
Route::post('update-customer/{id}', [ApiController::class,'update_customer']);
Route::post('save-payment-order', [ApiController::class,'save_payment_order']);
Route::get('customer/{id}', [ApiController::class,'customer_info']);
Route::post('packages',[ApiController::class,'packages']);
Route::post('change-my-password/{id}',[ApiController::class,'change_my_password']);
Route::post('cancel-my-order/{id}',[ApiController::class,'cancel_order_reason']);
Route::get('get-city-master',[ApiController::class,'get_city_master']);
Route::get('get-lab-location/{city_id?}',[ApiController::class,'get_lab_location']);


Route::post('/patients-consumers', [PatientsConsumersController::class, 'store'])->name('patients-consumers');
Route::post('/feedback', [FeedBackController::class, 'store'])->name('feedback');
Route::post('/faq', [FrequentlyAskedQuestionsController::class, 'store'])->name('faq');
Route::post('/hospital-lab-management', [HospitalLabManagementController::class, 'store'])->name('hospital-lab-management');
Route::post('/clinical-lab-management', [ClinicalLabManagementController::class, 'store'])->name('clinical-lab-management');
Route::post('/franchising-opportunities', [FranchisingOpportunitiesController::class, 'store'])->name('franchising-opportunities');
Route::post('/research', [ResearchController::class, 'store'])->name('research');
Route::post('/healthcheckup-for-employees', [HeadOfficeController::class, 'store'])->name('healthcheckup-for-employees');
Route::post('/book-an-appointment', [BookAppointmentController::class, 'store'])->name('book-an-appointment');
Route::post('/news-letter', [NewsLetterController::class, 'store'])->name('news-letter');
