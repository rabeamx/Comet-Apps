<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TestimonialController;

// admin auth routes
Route::group([ 'middleware' => 'admin.redirect' ], function(){
    Route::get('/admin-login', [AdminAuthController::class, 'showLoginPage']) -> name('admin.login.page');
    Route::post('/admin-login', [AdminAuthController::class, 'login']) -> name('admin.login');
});

// admin page routes
Route::group([ 'middleware' => 'admin' ], function(){
    Route::get('/dashboard', [AdminPageController::class, 'showdashboard']) -> name('admin.dashboard');
    Route::get('/admin-logout', [AdminAuthController::class, 'logout']) -> name('admin.logout');

// permission routes
Route::resource('/permission', PermissionController::class);
// role routes
Route::resource('/role', RoleController::class);
// user admin routes
Route::resource('/admin-user', AdminController::class);
Route::get('/admin-user-status-update/{id}', [AdminController::class, 'updateStatus']) -> name('admin.status.update');
Route::get('/admin-user-trash-update/{id}', [AdminController::class, 'updateTrash']) -> name('admin.trash.update');
Route::get('/admin-trash', [AdminController::class, 'trashUsers']) -> name('admin.trash');

// admin profile routes
Route::get('/admin-profile', [AdminProfileController::class, 'showAdminProfile']) -> name('admin.profile');
Route::post('/admin-profile-update', [AdminProfileController::class, 'changeAdminProfile']) -> name('admin.profile.update');
// admin password routes
Route::get('/admin-password', [AdminProfileController::class, 'showAdminPassword']) -> name('admin.password');
Route::post('/admin-password-update', [AdminProfileController::class, 'changeAdminPassword']) -> name('admin.password.update');

// frontend routes
Route::get('/', [FrontendPageController::class, 'showHomePage']) -> name('home.page');
// Slider routes
Route::resource('/sliders', SliderController::class);
Route::get('/sliders-status-update/{id}', [SliderController::class, 'updateStatus']) -> name('sliders.status.update');
Route::get('/sliders-trash-update/{id}', [SliderController::class, 'updateTrash']) -> name('sliders.trash.update');
Route::get('/sliders-trash', [SliderController::class, 'trashUsers']) -> name('sliders.trash');

// Testimonial routes
Route::resource('/testimonial', TestimonialController::class);

// Client routes
Route::resource('/client', ClientController::class);

});  