<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->patch('/user', [\App\Http\Controllers\UserController::class, 'update']);

Route::get('/products', [ProductController::class, 'index']);

// require __DIR__.'/auth.php';
