<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleBasedController;
use App\Http\Controllers\InterventionTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Protected routes for admin
Route::middleware(['auth:api', 'role:1'])->group(function () {

    Route::get('/intervention-list', [InterventionTypeController::class, 'index']);
    Route::get('/intervention-list/{id}', [InterventionTypeController::class, 'show']);
});

// Protected routes for Manager
Route::middleware(['auth:api', 'role:2'])->group(function () {
});

// Protected routes for Area chief
Route::middleware(['auth:api', 'role:3'])->group(function () {
});

// Protected routes for all roles
Route::middleware(['auth:api', 'role:1,2,3'])->group(function () {
    Route::get('/profile', [RoleBasedController::class, 'profile']);
});


// Auth routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});
