<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\ResidentController;

// Login / Logout
Route::post('v1/auth', [LoginController::class, 'login'])->name('login');
Route::post('v1/logout', [LoginController::class, 'logout'])
    ->middleware('auth:api')
    ->name('logout');


Route::middleware(['auth:api', 'tenant'])->prefix('v1')->group(function () {

    Route::get('authenticated/me', [LoginController::class, 'getAuthenticatedUser'])->name('me');

    // Residents
    Route::get('residents', [ResidentController::class, 'index'])->name('residents.index');
    Route::get('residents/{uuid}', [ResidentController::class, 'show'])->name('residents.show');
    Route::post('residents', [ResidentController::class, 'store'])->name('residents.store');
    Route::put('residents/{uuid}', [ResidentController::class, 'update'])->name('residents.update');
    Route::delete('residents/{uuid}', [ResidentController::class, 'destroy'])->name('residents.destroy');

    // Phones residents
    Route::get('resident/phones/{uuid}', [ResidentController::class, 'phones'])->name('residents.phones');
    Route::put('resident/phone/{uuid}', [ResidentController::class, 'phoneUpdate'])->name('residents.phones.update');
    Route::post('resident/phone', [ResidentController::class, 'phoneStore'])->name('residents.phones.store');

    Route::middleware('tenant.master')->group(function () {

        // Tenants
        Route::get('tenants', [TenantController::class, 'index'])->name('tenants.index');
        Route::get('tenants/{uuid}', [TenantController::class, 'show'])->name('tenants.show');
        Route::post('tenants', [TenantController::class, 'store'])->name('tenants.store');
        Route::put('tenants/{uuid}', [TenantController::class, 'update'])->name('tenants.update');
        Route::delete('tenants/{uuid}', [TenantController::class, 'destroy'])->name('tenants.destroy');
        Route::get('tenant/phones/{uuid}', [TenantController::class, 'phones'])->name('tenants.phones');

    });

});

