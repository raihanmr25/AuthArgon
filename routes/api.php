<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangPemakaianController;

// The URL for logging in
Route::post('/login', [AuthController::class, 'apiLogin']);

// These URLs are protected and require a valid login token
Route::middleware('auth:sanctum')->group(function () {
    // ADD this new, more flexible route
    Route::get('/find/{code}', [BarangPemakaianController::class, 'apiFindByCode']);

// The update route still needs to use the asset's ID to be specific
    Route::put('/asset/{barangPemakaian}', [BarangPemakaianController::class, 'apiUpdate'])->where('barangPemakaian', '[0-9]+');

});