<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ApiKeyController;

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

// Public routes - no authentication required
Route::get('/status', function() {
    return response()->json([
        'success' => true,
        'message' => 'API is running',
        'version' => '1.0.0',
    ]);
});

// Temporary route for retrieving attribute data (no auth required for testing)
Route::get('/get-attributes', [ProductController::class, 'getAttributes']);
Route::get('/update-product-attributes/{id?}', [ProductController::class, 'updateProductAttributes']);

// Protected Routes - Require API key authentication
Route::middleware('api.auth')->group(function () {
    // Product Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/search', [ProductController::class, 'search']);
    Route::get('/products/category/{categoryId}', [ProductController::class, 'byCategory']);
    Route::get('/products/brand/{brandId}', [ProductController::class, 'byBrand']);
    Route::get('/products/attributes', [ProductController::class, 'withAttributes']);
    Route::get('/products/debug/{id}', [ProductController::class, 'debugProduct']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/categories/{id}/products', [CategoryController::class, 'products']);

    // Brand Routes
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/{id}', [BrandController::class, 'show']);
    Route::get('/brands/{id}/products', [BrandController::class, 'products']);
});

// API Key Management Routes - Protected by web authentication
Route::middleware('web.auth')->prefix('api-keys')->group(function () {
    Route::get('/', [ApiKeyController::class, 'index']);
    Route::post('/', [ApiKeyController::class, 'store']);
    Route::get('/{id}', [ApiKeyController::class, 'show']);
    Route::put('/{id}', [ApiKeyController::class, 'update']);
    Route::delete('/{id}', [ApiKeyController::class, 'destroy']);
    Route::post('/{id}/regenerate', [ApiKeyController::class, 'regenerate']);
}); 