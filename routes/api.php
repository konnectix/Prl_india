<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Video;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API routes
Route::post('/videos/{video}/view', function (Video $video) {
    $video->increment('view_count');
    
    return response()->json([
        'success' => true,
        'view_count' => $video->view_count
    ]);
})->name('api.videos.view');
