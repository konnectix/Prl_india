<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryPhotoController;
use App\Http\Controllers\Admin\PressCategoryController;
use App\Http\Controllers\Admin\PressCoverageController;
use App\Http\Controllers\Admin\ContactLocationController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\VideoCategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\EsgCategoryController;
use App\Http\Controllers\Admin\EsgArticleController;
use Illuminate\Support\Facades\Route;


// Frontend routes
Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('frontend.home');
Route::get('/about', [App\Http\Controllers\Frontend\IndexController::class, 'about'])->name('frontend.about');
Route::get('/team', [App\Http\Controllers\Frontend\IndexController::class, 'team'])->name('frontend.team');
Route::get('/certificate', [App\Http\Controllers\Frontend\IndexController::class, 'certificate'])->name('frontend.certificate');
Route::get('/service', [App\Http\Controllers\Frontend\IndexController::class, 'service'])->name('frontend.service');
Route::get('/service-details/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'serviceDetails'])->name('frontend.service-details');
Route::get('/blog', [App\Http\Controllers\Frontend\IndexController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'blogDetails'])->name('frontend.blog-details');
Route::get('/investor', [App\Http\Controllers\Frontend\IndexController::class, 'investor'])->name('frontend.investor');
Route::get('/contact', [App\Http\Controllers\Frontend\IndexController::class, 'contact'])->name('frontend.contact');
Route::get('/press-coverage', [App\Http\Controllers\Frontend\IndexController::class, 'pressCoverage'])->name('frontend.press-coverage');
Route::get('/press-coverage/{id}', [App\Http\Controllers\Frontend\IndexController::class, 'pressCoverageDetails'])->name('frontend.press-coverage-details');
Route::get('/photo', [App\Http\Controllers\Frontend\IndexController::class, 'photo'])->name('frontend.photo');
Route::get('/video', [App\Http\Controllers\Frontend\IndexController::class, 'video'])->name('frontend.video');
Route::get('/cmd', [App\Http\Controllers\Frontend\IndexController::class, 'cmd'])->name('frontend.cmd');
Route::get('/esg', [App\Http\Controllers\Frontend\IndexController::class, 'esg'])->name('frontend.esg');
Route::get('/esg/{category}', [App\Http\Controllers\Frontend\IndexController::class, 'esgCategory'])->name('frontend.esg-category');
Route::get('/esg/{category}/{article}', [App\Http\Controllers\Frontend\IndexController::class, 'esgDetails'])->name('frontend.esg-article');

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

        // Press Coverage Management Routes
        Route::resource('press/categories', PressCategoryController::class)->names([
            'index' => 'press.categories.index',
            'create' => 'press.categories.create',
            'store' => 'press.categories.store',
            'show' => 'press.categories.show',
            'edit' => 'press.categories.edit',
            'update' => 'press.categories.update',
            'destroy' => 'press.categories.destroy',
        ]);

        Route::resource('press/articles', PressCoverageController::class)->names([
            'index' => 'press.articles.index',
            'create' => 'press.articles.create',
            'store' => 'press.articles.store',
            'show' => 'press.articles.show',
            'edit' => 'press.articles.edit',
            'update' => 'press.articles.update',
            'destroy' => 'press.articles.destroy',
        ]);

        Route::post('/press/articles/bulk-delete', [PressCoverageController::class, 'bulkDelete'])->name('press.articles.bulk-delete');
        Route::patch('/press/articles/{article}/toggle-featured', [PressCoverageController::class, 'toggleFeatured'])->name('press.articles.toggle-featured');
        Route::patch('/press/articles/{article}/toggle-status', [PressCoverageController::class, 'toggleStatus'])->name('press.articles.toggle-status');

        // Contact Management Routes
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::resource('locations', ContactLocationController::class, [
                'names' => [
                    'index' => 'locations.index',
                    'create' => 'locations.create',
                    'store' => 'locations.store',
                    'show' => 'locations.show',
                    'edit' => 'locations.edit',
                    'update' => 'locations.update',
                    'destroy' => 'locations.destroy',
                ]
            ]);
            Route::patch('/locations/{location}/toggle-status', [ContactLocationController::class, 'toggleStatus'])->name('locations.toggle-status');
            Route::patch('/locations/{location}/set-default', [ContactLocationController::class, 'setDefault'])->name('locations.set-default');

            Route::resource('info', ContactInfoController::class, [
                'names' => [
                    'index' => 'info.index',
                    'create' => 'info.create',
                    'store' => 'info.store',
                    'show' => 'info.show',
                    'edit' => 'info.edit',
                    'update' => 'info.update',
                    'destroy' => 'info.destroy',
                ]
            ]);
            Route::patch('/info/{info}/toggle-status', [ContactInfoController::class, 'toggleStatus'])->name('info.toggle-status');
        });

        // Video Management Routes
        Route::prefix('video')->name('video.')->group(function () {
            Route::resource('categories', VideoCategoryController::class, [
                'names' => [
                    'index' => 'categories.index',
                    'create' => 'categories.create',
                    'store' => 'categories.store',
                    'show' => 'categories.show',
                    'edit' => 'categories.edit',
                    'update' => 'categories.update',
                    'destroy' => 'categories.destroy',
                ]
            ]);

            Route::resource('videos', VideoController::class, [
                'names' => [
                    'index' => 'videos.index',
                    'create' => 'videos.create',
                    'store' => 'videos.store',
                    'show' => 'videos.show',
                    'edit' => 'videos.edit',
                    'update' => 'videos.update',
                    'destroy' => 'videos.destroy',
                ]
            ]);
            Route::post('/videos/bulk-delete', [VideoController::class, 'bulkDelete'])->name('videos.bulk-delete');
            Route::patch('/videos/{video}/toggle-featured', [VideoController::class, 'toggleFeatured'])->name('videos.toggle-featured');
            Route::patch('/videos/{video}/toggle-status', [VideoController::class, 'toggleStatus'])->name('videos.toggle-status');
        });

        // ESG Management Routes
        Route::prefix('esg')->name('esg.')->group(function () {
            Route::resource('categories', EsgCategoryController::class, [
                'names' => [
                    'index' => 'categories.index',
                    'create' => 'categories.create',
                    'store' => 'categories.store',
                    'show' => 'categories.show',
                    'edit' => 'categories.edit',
                    'update' => 'categories.update',
                    'destroy' => 'categories.destroy',
                ]
            ]);

            Route::resource('articles', EsgArticleController::class, [
                'names' => [
                    'index' => 'articles.index',
                    'create' => 'articles.create',
                    'store' => 'articles.store',
                    'show' => 'articles.show',
                    'edit' => 'articles.edit',
                    'update' => 'articles.update',
                    'destroy' => 'articles.destroy',
                ]
            ]);
            Route::post('/articles/bulk-delete', [EsgArticleController::class, 'bulkDelete'])->name('articles.bulk-delete');
            Route::patch('/articles/{article}/toggle-featured', [EsgArticleController::class, 'toggleFeatured'])->name('articles.toggle-featured');
            Route::patch('/articles/{article}/toggle-status', [EsgArticleController::class, 'toggleStatus'])->name('articles.toggle-status');
        });
    });
});
