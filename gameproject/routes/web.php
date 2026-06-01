<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

// Review Submit (public)

Route::post('/reviews', [HomeController::class, 'submitReview'])->name('review.submit');

// Admin Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);
});

// Admin Panel Routes (Protected by Auth Middleware)
Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/admin/logout', [AdminController::class, 'logout']);

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Apps CRUD
    Route::get('/admin/apps', [AdminController::class, 'index'])->name('admin.apps.index');
    Route::get('/admin/apps/create', [AdminController::class, 'create'])->name('admin.apps.create');
    Route::post('/admin/apps/store', [AdminController::class, 'store'])->name('admin.apps.store');
    Route::get('/admin/apps/{id}/edit', [AdminController::class, 'edit'])->name('admin.apps.edit');
    Route::post('/admin/apps/{id}/update', [AdminController::class, 'update'])->name('admin.apps.update');
    Route::get('/admin/apps/{id}/delete', [AdminController::class, 'destroy'])->name('admin.apps.delete');

    // Contact Queries Management
    Route::get('/admin/queries', [AdminController::class, 'queries'])->name('admin.queries.index');
    Route::get('/admin/queries/{id}/delete', [AdminController::class, 'destroyQuery'])->name('admin.queries.delete');

    // Reviews Management
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews.index');
    Route::get('/admin/reviews/{id}/approve', [AdminController::class, 'approveReview'])->name('admin.reviews.approve');
    Route::get('/admin/reviews/{id}/delete', [AdminController::class, 'destroyReview'])->name('admin.reviews.delete');

    // General Site Settings
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings']);
});

// Dynamic Game Detail Route (Must be at the very bottom to avoid conflicts with static endpoints)
Route::get('/{slug}', [HomeController::class, 'detail'])->name('game.detail');
