<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AreaChiefController;
use App\Http\Controllers\RoleBasedController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\CompanyTypeController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\AdministratorController;
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
});

// Protected routes for Manager
Route::middleware(['auth:api', 'role:2'])->group(function () {
});

// Protected routes for Area chief
Route::middleware(['auth:api', 'role:3'])->group(function () {
});

// Protected routes for admin and manager
Route::middleware(['auth:api', 'role:1,2'])->group(function () {
});

// Protected routes for admin and area chief
Route::middleware(['auth:api', 'role:1,3'])->group(function () {

    Route::get('/interventions-types', [InterventionTypeController::class, 'index']);
});

// Protected routes for all roles
Route::middleware(['auth:api', 'role:1,2,3'])->group(function () {
    Route::get('/profile', [RoleBasedController::class, 'profile']);

    // Show resources
    Route::get('/administrators', [AdministratorController::class, 'index']);
    Route::get('/administrators/{id}', [AdministratorController::class, 'show']);

    Route::get('/managers', [ManagerController::class, 'index']);
    Route::get('/managers/{id}', [ManagerController::class, 'show']);

    Route::get('/area-chiefs', [AreaChiefController::class, 'index']);
    Route::get('/area-chiefs/{id}', [AreaChiefController::class, 'show']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);

    Route::get('/intervention-types', [InterventionTypeController::class, 'index']);
    Route::get('/intervention-types/{id}', [InterventionTypeController::class, 'show']);

    Route::get('/interventions', [InterventionController::class, 'index']);
    Route::get('/interventions/{id}', [InterventionController::class, 'show']);

    Route::get('/companies', [CompanyController::class, 'index']);
    Route::get('/companies/{id}', [CompanyController::class, 'show']);

    Route::get('/company-types', [CompanyTypeController::class, 'index']);
    Route::get('/company-types/{id}', [CompanyTypeController::class, 'show']);

    Route::get('/areas', [AreaController::class, 'index']);
    Route::get('/areas/{id}', [AreaController::class, 'show']);

    Route::get('/workers', [WorkerController::class, 'index']);
    Route::get('/workers/{id}', [WorkerController::class, 'show']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);

    Route::get('/status', [StatusController::class, 'index']);
    Route::get('/status/{id}', [StatusController::class, 'show']);

    Route::get('/evaluations', [EvaluationController::class, 'index']);
    Route::get('/evaluations/{id}', [EvaluationController::class, 'show']);
    Route::get('/evaluations/worker/{id}', [EvaluationController::class, 'workerEvaluations']);
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
