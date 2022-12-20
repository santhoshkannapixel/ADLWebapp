<?php

use App\Http\Controllers\Website\ClinicalLabManagementController;
use App\Http\Controllers\Website\HospitalLabManagementController;
use App\Http\Controllers\Website\FrequentlyAskedQuestionsController;
use App\Http\Controllers\Website\FeedBackController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Website\BookAppointmentController;
use App\Http\Controllers\Website\FranchisingOpportunitiesController;
use App\Http\Controllers\Website\HeadOfficeController;
use App\Http\Controllers\Website\NewsLetterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\PatientsConsumersController;
use App\Http\Controllers\Website\ResearchController;

Route::get('banners', [ApiController::class,'banners']);
Route::get('topBookedTest', [ApiController::class,'topBookedTest']);
Route::get('test/{id}', [ApiController::class,'testDetails']);
Route::post('test-list/{type?}', [ApiController::class,'testLists']);
Route::post('bannerContactForm', [ApiController::class,'bannerContactForm']);
Route::post('newsAndEvents', [ApiController::class,'newsAndEvents']);
Route::post('register', [ApiController::class,'register']);


// Route::get('/patients-consumers/{id}', [PatientsConsumersController::class, 'index'])->name('patients-consumers');
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

