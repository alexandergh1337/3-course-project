<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->patch('/user', [\App\Http\Controllers\UserController::class, 'update']);

// require __DIR__.'/auth.php';
