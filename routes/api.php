<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\PersonalRecordController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user/{id}', [UserController::class, 'read']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/movements', [MovementController::class, 'index']);
    Route::post('/movement', [MovementController::class, 'create']);
    Route::get('/movement/{id}', [MovementController::class, 'read']);
    Route::put('/movement/{id}', [MovementController::class, 'update']);
    Route::delete('/movement/{id}', [MovementController::class, 'delete']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/personal-records', [PersonalRecordController::class, 'index']);
    Route::post('/personal-records', [PersonalRecordController::class, 'create']);
    Route::get('/personal-records/{id}', [PersonalRecordController::class, 'read']);
    Route::put('/personal-records/{id}', [PersonalRecordController::class, 'update']);
    Route::delete('/personal-records/{id}', [PersonalRecordController::class, 'delete']);
    Route::get('/personal-records/ranking/{movement_id}', [PersonalRecordController::class, 'getMovementRanking']);
});
