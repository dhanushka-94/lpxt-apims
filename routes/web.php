<?php

use App\Http\Controllers\ApiDocumentationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiDataViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes - No authentication required
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes - require web authentication
Route::middleware('web.auth')->group(function () {
    // Home page - always protected
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // API Documentation
    Route::get('/api/docs', [ApiDocumentationController::class, 'index'])->name('api.docs');
    
    // API Data View - table of all API data
    Route::get('/api/data-view', [ApiDataViewController::class, 'index'])->name('api.data-view');
    
    // Domain Configuration
    Route::get('/admin/domain-config', function () {
        return view('admin.domain-config');
    })->name('admin.domain-config');
});

// Redirect any other route to login
Route::fallback(function () {
    return redirect()->route('login');
});
