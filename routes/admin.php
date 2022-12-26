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
use App\Http\Controllers\Admin\BookAppointmentController;
use App\Http\Controllers\Admin\HeadOfficeController;
use App\Http\Controllers\Admin\ReachUsController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\HospitalLabManagementController;
use App\Http\Controllers\Admin\ClinicalLabManagementController;
use App\Http\Controllers\Admin\HealthCheckupController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApiConfigController;
use App\Http\Controllers\Admin\ResearchController;
use App\Http\Controllers\Admin\PaymentConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsAndEventsController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth_users'])->group(function () {

    // ================================================= //
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        });
        // Route::group(['prefix' => 'settings'], function () {
            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->name('user.index');
                Route::get('create', [UserController::class, 'create'])->name('user.create');
                Route::post('create', [UserController::class, 'store'])->name('user.store');
                Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
                Route::put('edit/{id}', [UserController::class, 'update'])->name('user.update');
                Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
            });
            Route::group(['prefix' => 'role'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('role.index');
                Route::get('create', [RoleController::class, 'create'])->name('role.create');
                Route::post('create', [RoleController::class, 'store'])->name('role.store');
                Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
                Route::put('edit/{id}', [RoleController::class, 'update'])->name('role.update');
                Route::delete('delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
            });
            Route::group(['prefix' => 'api-config'], function () {
                Route::get('/', [ApiConfigController::class, 'index'])->name('api_config.index');
                Route::get('create', [ApiConfigController::class, 'create'])->name('api_config.create');
                Route::post('create', [ApiConfigController::class, 'store'])->name('api_config.store');
                Route::get('edit/{id}', [ApiConfigController::class, 'edit'])->name('api_config.edit');
                Route::post('edit/{id?}', [ApiConfigController::class, 'update'])->name('api_config.update');
                Route::delete('delete/{id}', [ApiConfigController::class, 'destroy'])->name('api_config.delete');
            });
            Route::group(['prefix' => 'payment-config'], function () {
                Route::get('/', [PaymentConfigController::class, 'index'])->name('payment_config.index');
                Route::get('create', [PaymentConfigController::class, 'create'])->name('payment_config.create');
                Route::post('create', [PaymentConfigController::class, 'store'])->name('payment_config.store');
                Route::get('edit/{id}', [PaymentConfigController::class, 'edit'])->name('payment_config.edit');
                Route::post('/edit/{id?}', [PaymentConfigController::class, 'update'])->name('payment_config.update');
                Route::delete('/payment-config-delete/{id}', [PaymentConfigController::class, 'destroy'])->name('payment_config.delete');
            });
        // });
        Route::group(['prefix' => 'master'], function () {
            Route::group(['prefix' => 'branch'], function () {
                Route::get('/', [BranchController::class, 'index'])->name('master.index');
                Route::post('/', [BranchController::class, 'syncRequest'])->name('branch.sync');
                Route::get('show/{id}', [BranchController::class, 'show'])->name('branch.show');
            });
            Route::group(['prefix' => 'city'], function () {
                Route::get('/', [CityController::class, 'index'])->name('city.index');
                Route::post('/', [CityController::class, 'syncRequest'])->name('city.sync');
            });
            Route::group(['prefix' => 'test'], function () {
                Route::get('/', [TestController::class, 'index'])->name('test.index');
                Route::post('/', [TestController::class, 'syncRequest'])->name('test.sync');
                Route::get('show/{id}', [TestController::class, 'show'])->name('test.show');
                Route::get('edit/{id}', [TestController::class, 'edit'])->name('test.edit');
                Route::post('edit/{id}', [TestController::class, 'update'])->name('test.edit');
            });
            Route::group(['prefix' => 'banner'], function () {
                Route::get('/', [BannerController::class, 'index'])->name('banner.index');
                Route::get('create', [BannerController::class, 'create'])->name('banner.create');
                Route::post('create/{id?}', [BannerController::class, 'store'])->name('banner.store');
                Route::get('edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
                Route::delete('delete/{id?}', [BannerController::class, 'delete'])->name('banner.delete');
            });
            Route::get('news-letter', [NewsLetterController::class, 'index'])->name('news-letter.index');
            Route::get('news-letter/{id}', [NewsLetterController::class, 'show'])->name('news-letter.show');
            Route::post('news-letter/{id?}', [NewsLetterController::class, 'delete'])->name('news-letter.delete');
        });
        Route::group(['prefix' => 'news-and-events'], function () {
            Route::get('/', [NewsAndEventsController::class, 'index'])->name('news-and-events.index');
            Route::get('create', [NewsAndEventsController::class, 'create'])->name('news-and-events.create');
            Route::post('create/{id?}', [NewsAndEventsController::class, 'store'])->name('news-and-events.store');
            Route::post('update/{id?}', [NewsAndEventsController::class, 'update'])->name('news-and-events.update');
            Route::get('edit/{id}', [NewsAndEventsController::class, 'edit'])->name('news-and-events.edit');
            Route::delete('delete/{id?}', [NewsAndEventsController::class, 'destroy'])->name('news-and-events.destroy');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
            Route::get('/show/{id}', [OrdersController::class, 'show'])->name('orders.show');
            Route::post('/change-order-status/{id}', [OrdersController::class, 'change_order_status'])->name('orders.change-order-status');
        });
        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
            Route::get('/show/{id}', [CustomersController::class, 'show'])->name('customers.show');
        });

    // ================================================= //


    Route::get('patients', [EnquiryController::class, 'index'])->name('patients.index');
    Route::get('doctors', [DoctorsController::class, 'index'])->name('doctors.index');
    Route::get('health-checkup', [HealthCheckupController::class, 'index'])->name('health-checkup.index');
    Route::get('reach-us', [ReachUsController::class, 'index'])->name('reach-us.index');

    Route::get('/home-collection', [BookHomeCollectionController::class, 'index'])->name('home-collection.index');
    Route::post('/home-collection/{id}', [BookHomeCollectionController::class, 'destroy'])->name('home-collection.delete');
    Route::get('/home-collection/{id}', [BookHomeCollectionController::class, 'show'])->name('home-collection.show');

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

    Route::get('/patients-consumers', [PatientsConsumersController::class, 'index'])->name('patients-consumers.index');
    Route::post('/patients-consumers/{id}', [PatientsConsumersController::class, 'destroy'])->name('patients-consumers.delete');
    Route::get('/patients-consumers/{id}', [PatientsConsumersController::class, 'show'])->name('patients-consumers.show');

    Route::get('/book-an-appointment', [BookAppointmentController::class, 'index'])->name('book-an-appointment.index');
    Route::post('/book-an-appointment/{id}', [BookAppointmentController::class, 'destroy'])->name('book-an-appointment.delete');
    Route::get('/book-an-appointment/{id}', [BookAppointmentController::class, 'show'])->name('book-an-appointment.show');

    Route::get('/head-office', [HeadOfficeController::class, 'index'])->name('head-office.index');
    Route::post('/head-office/{id}', [HeadOfficeController::class, 'destroy'])->name('head-office.delete');
    Route::get('/head-office/{id}', [HeadOfficeController::class, 'show'])->name('head-office.show');
});
