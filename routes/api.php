<?php

use App\Http\Controllers\Api\v1\RoleController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\ResidentController;

// Login / Logout
Route::post('v1/auth', [LoginController::class, 'login'])->name('login');
Route::post('v1/logout', [LoginController::class, 'logout'])->middleware('auth:api')->name('logout');

Route::middleware(['auth:api', 'tenant'])->prefix('v1')->group(function () {

    Route::get('authenticated/me', [LoginController::class, 'getAuthenticatedUser'])->name('me');

    // Residents
    Route::apiResource('residents', ResidentController::class);

    // Phones residents
    Route::get('resident/phones/{uuid}', [ResidentController::class, 'phones'])->name('residents.phones');
    Route::put('resident/phone/{uuid}', [ResidentController::class, 'phoneUpdate'])->name('residents.phones.update');
    Route::post('resident/phone', [ResidentController::class, 'phoneStore'])->name('residents.phones.store');

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

    // Tenant master
    Route::middleware('tenant.master')->group(function () {

        // Tenants
        Route::apiResource('tenants', TenantController::class);
        Route::get('tenant/phones/{uuid}', [TenantController::class, 'phones'])->name('tenants.phones');

        // Users
        Route::apiResource('users', UserController::class);

    });

});
