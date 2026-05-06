<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['status' => 'ok', 'app' => 'DA03 TaskManager API']));

// Autenticació
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Endpoints públics
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/{task}', [TaskController::class, 'show']);

// Endpoints privats amb Bearer Token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
