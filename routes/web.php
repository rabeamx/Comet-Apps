<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PortfolioCategoryController;

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

// Slider routes
Route::resource('/sliders', SliderController::class);
Route::get('/sliders-status-update/{id}', [SliderController::class, 'updateStatus']) -> name('sliders.status.update');
Route::get('/sliders-trash-update/{id}', [SliderController::class, 'updateTrash']) -> name('sliders.trash.update');
Route::get('/sliders-trash', [SliderController::class, 'trashUsers']) -> name('sliders.trash');
// Testimonial routes
Route::resource('/testimonial', TestimonialController::class);
Route::get('/testimonial-status-update/{id}', [TestimonialController::class, 'updateStatus']) -> name('testimonial.status.update');
Route::get('/testimonial-trash-update/{id}', [TestimonialController::class, 'updateTrash']) -> name('testimonial.trash.update');
Route::get('/testimonial-trash', [TestimonialController::class, 'trashTestimonials']) -> name('testimonial.trash');
// Client routes
Route::resource('/client', ClientController::class);
Route::get('/client-status-update/{id}', [ClientController::class, 'updateStatus']) -> name('client.status.update');
Route::get('/client-trash-update{id}', [ClientController::class, 'updateTrash']) -> name('client.trash.update');
Route::get('/client-trash', [ClientController::class, 'trashClients']) -> name('client.trash');
// Counter routes
Route::resource('/counter', CounterController::class);
Route::get('/counter-status-update/{id}', [CounterController::class, 'updateStatus']) -> name('counter.status.update');
Route::get('/counter-trash-update/{id}', [CounterController::class, 'updateTrash']) -> name('counter.trash.update');
Route::get('/counter-trash', [CounterController::class, 'trashCounters']) -> name('counter.trash');
// Category routes
Route::resource('/portfolio-category', PortfolioCategoryController::class);
Route::get('/portfolio-category-status-update/{id}', [PortfolioCategoryController::class, 'updateStatus']) -> name('portfolio-category.status.update');
Route::get('portfolio-category-trash-update/{id}', [PortfolioCategoryController::class, 'updateTrash']) -> name('portfolio-category-trash-update');
Route::get('/portfolio-category-trash', [PortfolioCategoryController::class, 'trash/portfolioCategory']) -> name('portfolio-category.trash');

// Portfolio routes
Route::resource('/portfolio', PortfolioController::class);


});   

// frontend routes
Route::get('/', [FrontendPageController::class, 'showHomePage']) -> name('home.page');
Route::get('/contact', [FrontendPageController::class, 'showContactPage']) -> name('contact.page');
Route::get('/portfolio-single/{slug}', [FrontendPageController::class, 'showSinglePortfolioPage']) -> name('portfolio.single.page');