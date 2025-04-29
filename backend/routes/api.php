<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->patch('/user', [\App\Http\Controllers\UserController::class, 'update']);

Route::get('/products', [ProductController::class, 'index']);

Route::middleware(['auth:sanctum'])->get('/cart', [CartController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('/cart', [CartController::class, 'add']);
Route::middleware(['auth:sanctum'])->delete('/cart', [CartController::class, 'remove']);
Route::middleware(['auth:sanctum'])->patch('/cart', [CartController::class, 'updateQuantity']);
Route::middleware(['auth:sanctum'])->post('/cart/checkout', [CartController::class, 'checkout']);
Route::middleware(['auth:sanctum'])->get('/orders', [OrderController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/favorites', [FavoriteController::class, 'index']);
Route::middleware(['auth:sanctum'])->post('/favorites', [FavoriteController::class, 'store']);
Route::middleware(['auth:sanctum'])->delete('/favorites', [FavoriteController::class, 'destroy']);

// require __DIR__.'/auth.php';
