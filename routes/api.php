<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\ResidentController;

// Login
Route::post('v1/auth', [LoginController::class, 'login']);

Route::middleware(['auth:api', 'tenant'])->prefix('v1')->group(function () {

    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('authenticated/me', [LoginController::class, 'getAuthenticatedUser']);

    // Users
//    Route::get('users', [UserController::class, 'index']);
//    Route::get('users/{uuid}', [UserController::class, 'show']);
//    Route::post('users', [UserController::class, 'store']);
//    Route::put('users/{uuid}', [UserController::class, 'update']);
//    Route::delete('users/{uuid}', [UserController::class, 'destroy']);

    // Residents
    Route::get('residents', [ResidentController::class, 'index']);
    Route::get('residents/{uuid}', [ResidentController::class, 'show']);
    Route::post('residents', [ResidentController::class, 'store']);
    Route::put('residents/{uuid}', [ResidentController::class, 'update']);
    Route::delete('residents/{uuid}', [ResidentController::class, 'destroy']);

    // Tenants
    Route::get('tenants', [TenantController::class, 'index']);
    Route::get('tenants/{uuid}', [TenantController::class, 'show']);
    Route::post('tenants', [TenantController::class, 'store']);
    Route::put('tenants/{uuid}', [TenantController::class, 'update']);
    Route::delete('tenants/{uuid}', [TenantController::class, 'destroy']);

});

