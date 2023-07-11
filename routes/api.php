<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
Route::patch('/update/user/admin', [AuthController::class, 'updateAdmin']);
Route::delete('/delete/user', [AuthController::class, 'deleteAdmin']);

//admin
Route::middleware('auth:sanctum')->group(function () {
    // Pengawas Routes
    Route::middleware('pengawas')->group(function () {
        Route::get('/users', [AuthController::class, 'indexUsers']);
        // Define pengawas-only routes here
        Route::get('/pengawas', function () {
            return 'Pengawas Dashboard';
        });
    });

    // Pelaksana Routes
    Route::middleware('pelaksana')->group(function () {
        // Define pelaksana-only routes here
        Route::get('/pelaksana', function () {
            return 'Pelaksana Dashboard';
        });
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'me']);
});
