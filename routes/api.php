<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/company', [CompanyController::class, 'show']);

    Route::post('/checkin', [App\Http\Controllers\Api\AttendanceController::class, 'checkin']);

    Route::post('/checkout', [App\Http\Controllers\Api\AttendanceController::class, 'checkout']);

    Route::get('/is-checkin', [App\Http\Controllers\Api\AttendanceController::class, 'isCheckedin']);

    Route::post('/update-profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile']);

    Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class);

    Route::apiResource('/api-notes', App\Http\Controllers\Api\NoteController::class);
});
