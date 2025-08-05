<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryPhotoController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Default login redirect
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (not authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });
    
    // Authenticated routes
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // Gallery Management Routes
        Route::resource('gallery/categories', GalleryCategoryController::class)->names([
            'index' => 'gallery.categories.index',
            'create' => 'gallery.categories.create',
            'store' => 'gallery.categories.store',
            'show' => 'gallery.categories.show',
            'edit' => 'gallery.categories.edit',
            'update' => 'gallery.categories.update',
            'destroy' => 'gallery.categories.destroy',
        ]);
        
        Route::resource('gallery/photos', GalleryPhotoController::class)->names([
            'index' => 'gallery.photos.index',
            'create' => 'gallery.photos.create',
            'store' => 'gallery.photos.store',
            'show' => 'gallery.photos.show',
            'edit' => 'gallery.photos.edit',
            'update' => 'gallery.photos.update',
            'destroy' => 'gallery.photos.destroy',
        ]);
        
        Route::post('/gallery/photos/bulk-delete', [GalleryPhotoController::class, 'bulkDelete'])->name('gallery.photos.bulk-delete');
    });
});

