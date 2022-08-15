<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;


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
    Route::resource('/admin-user', RoleController::class);

});