<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\ResidentController;

// Login
Route::post('v1/auth', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:api', 'tenant'])->prefix('v1')->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('authenticated/me', [LoginController::class, 'getAuthenticatedUser'])->name('me');

    // Users
//    Route::get('users', [UserController::class, 'index']);
//    Route::get('users/{uuid}', [UserController::class, 'show']);
//    Route::post('users', [UserController::class, 'store']);
//    Route::put('users/{uuid}', [UserController::class, 'update']);
//    Route::delete('users/{uuid}', [UserController::class, 'destroy']);

    // Residents
    Route::get('residents', [ResidentController::class, 'index'])->name('residents.index');
    Route::get('residents/{uuid}', [ResidentController::class, 'show'])->name('residents.show');
    Route::post('residents', [ResidentController::class, 'store'])->name('residents.store');
    Route::put('residents/{uuid}', [ResidentController::class, 'update'])->name('residents.update');
    Route::delete('residents/{uuid}', [ResidentController::class, 'destroy'])->name('residents.destroy');

    // Tenants
    Route::get('tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('tenants/{uuid}', [TenantController::class, 'show'])->name('tenants.show');
    Route::post('tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::put('tenants/{uuid}', [TenantController::class, 'update'])->name('tenants.update');
    Route::delete('tenants/{uuid}', [TenantController::class, 'destroy'])->name('tenants.destroy');

});

