<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::apiResource('usuario', UserController::class);
    Route::apiResource('cliente', CustomerController::class);
    Route::apiResource('carro', CarController::class);
    Route::apiResource('marca', BrandController::class);
    Route::apiResource('modelo', CarModelController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('/reset-password/{user}', [PasswordResetController::class, 'resetPassword']);
});

Route::post('login', [AuthController::class, 'login']);
