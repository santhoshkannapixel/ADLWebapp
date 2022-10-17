<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\BookHomeCollectionController;
use App\Http\Controllers\Admin\PatientsConsumersController;
use App\Http\Controllers\Admin\FeedBackController;
use App\Http\Controllers\Admin\FrequentlyAskedQuestionsController;
use App\Http\Controllers\Admin\FranchisingOpportunitiesController;
use App\Http\Controllers\Admin\CovidTestingEmployeesController;
use App\Http\Controllers\Admin\BookAppointmentController;
use App\Http\Controllers\Admin\HeadOfficeController;
use App\Http\Controllers\Admin\ReachUsController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\HospitalLabManagementController;
use App\Http\Controllers\Admin\ClinicalLabManagementController;
use App\Http\Controllers\Admin\AnandFranchiseController;
use App\Http\Controllers\Admin\HealthCheckupController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApiConfigController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\PaymentConfigController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth_users'])->group(function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
        Route::get('patients', [EnquiryController::class, 'index'])->name('admin.patients');
        Route::get('doctors', [DoctorsController::class, 'index'])->name('admin.doctors');
        Route::get('health-checkup', [HealthCheckupController::class, 'index'])->name('admin.health-checkup');
        Route::get('reach-us', [ReachUsController::class, 'index'])->name('admin.reach-us');

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

        //home-collection
        Route::get('/home-collection', [BookHomeCollectionController::class, 'index'])->name('home-collection.index');
        Route::post('/home-collection/{id}', [BookHomeCollectionController::class, 'destroy'])->name('home-collection.delete');
        Route::get('/home-collection/{id}', [BookHomeCollectionController::class, 'show'])->name('home-collection.show');
        //patients-consumers
        Route::get('/feedback', [FeedBackController::class, 'index'])->name('feedback.index');
        Route::post('/feedback/{id}', [FeedBackController::class, 'destroy'])->name('feedback.delete');
        Route::get('/feedback/{id}', [FeedBackController::class, 'show'])->name('feedback.show');

        Route::get('/faq', [FrequentlyAskedQuestionsController::class, 'index'])->name('faq.index');
        Route::post('/faq/{id}', [FrequentlyAskedQuestionsController::class, 'destroy'])->name('faq.delete');
        Route::get('/faq/{id}', [FrequentlyAskedQuestionsController::class, 'show'])->name('faq.show');

        Route::get('/hospital-lab-management', [HospitalLabManagementController::class, 'index'])->name('hospital-lab-management.index');
        Route::post('/hospital-lab-management/{id}', [HospitalLabManagementController::class, 'destroy'])->name('hospital-lab-management.delete');
        Route::get('/hospital-lab-management/{id}', [HospitalLabManagementController::class, 'show'])->name('hospital-lab-management.show');

        Route::get('/clinical-lab-management', [ClinicalLabManagementController::class, 'index'])->name('clinical-lab-management.index');
        Route::post('/clinical-lab-management/{id}', [ClinicalLabManagementController::class, 'destroy'])->name('clinical-lab-management.delete');
        Route::get('/clinical-lab-management/{id}', [ClinicalLabManagementController::class, 'show'])->name('clinical-lab-management.show');

        Route::get('/franchising-opportunities', [FranchisingOpportunitiesController::class, 'index'])->name('franchising-opportunities.index');
        Route::post('/franchising-opportunities/{id}', [FranchisingOpportunitiesController::class, 'destroy'])->name('franchising-opportunities.delete');
        Route::get('/franchising-opportunities/{id}', [FranchisingOpportunitiesController::class, 'show'])->name('franchising-opportunities.show');

        Route::get('/research', [ResearchController::class, 'index'])->name('research.index');
        Route::post('/research/{id}', [ResearchController::class, 'destroy'])->name('research.delete');
        Route::get('/research/{id}', [ResearchController::class, 'show'])->name('research.show');

        //feedback.index
        Route::get('/patients-consumers', [PatientsConsumersController::class, 'index'])->name('patients-consumers.index');
        Route::post('/patients-consumers/{id}', [PatientsConsumersController::class, 'destroy'])->name('patients-consumers.delete');
        Route::get('/patients-consumers/{id}', [PatientsConsumersController::class, 'show'])->name('patients-consumers.show');

        //feedback.index
        Route::get('/book-an-appointment', [BookAppointmentController::class, 'index'])->name('book-an-appointment.index');
        Route::post('/book-an-appointment/{id}', [BookAppointmentController::class, 'destroy'])->name('book-an-appointment.delete');
        Route::get('/book-an-appointment/{id}', [BookAppointmentController::class, 'show'])->name('book-an-appointment.show');

        Route::get('/head-office', [HeadOfficeController::class, 'index'])->name('head-office.index');
        Route::post('/head-office/{id}', [HeadOfficeController::class, 'destroy'])->name('head-office.delete');
        Route::get('/head-office/{id}', [HeadOfficeController::class, 'show'])->name('head-office.show');

        Route::get('/anandlab-franchise', [AnandFranchiseController::class, 'index'])->name('anandlab-franchise.index');
        Route::post('/anandlab-franchise/{id}', [AnandFranchiseController::class, 'destroy'])->name('anandlab-franchise.delete');
        Route::get('/anandlab-franchise/{id}', [AnandFranchiseController::class, 'show'])->name('anandlab-franchise.show');

        Route::get('/covidtesting-employees', [CovidTestingEmployeesController::class, 'index'])->name('covidtesting-employees.index');
        Route::post('/covidtesting-employees/{id}', [CovidTestingEmployeesController::class, 'destroy'])->name('covidtesting-employees.delete');
        Route::get('/covidtesting-employees/{id}', [CovidTestingEmployeesController::class, 'show'])->name('covidtesting-employees.show');



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
