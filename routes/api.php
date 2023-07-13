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

// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/register', [AuthController::class, 'register']);

// Route::patch('/update/user/admin', [AuthController::class, 'updateAdmin']);
// Route::delete('/delete/user', [AuthController::class, 'deleteAdmin']);

// Route::get('/users', [AuthController::class, 'indexUsers']);


//admin

// Route::middleware(['auth', 'user-role:admin'])->group(function () {
//     Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'me']);
// });
// Route::middleware(['auth', 'user-role:pengawas'])->group(function () {
//     Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'me']);
// });

// Route::middleware(['auth', 'user-role:pelaksana'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'me']);
// });

// Route::middleware('auth:sanctum')->group(function () {
//     // Pengawas Routes

//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'me']);
// });
