<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

// 1. Endpoint untuk Login (Dapat Token)
Route::post('/login', [AuthController::class, 'getToken']);

// 2. Endpoint Publik (Bisa diakses tanpa token)
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);

// 3. Endpoint Terproteksi (Wajib pakai token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // CRUD Product (POST, PUT, DELETE)
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    // CRUD Category (POST, PUT, DELETE)
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    
});