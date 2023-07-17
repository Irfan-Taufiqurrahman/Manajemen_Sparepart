<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('web')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.loginIndex');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/registers', [AuthController::class, 'showRegistrationForm'])->name('auth.registerIndex');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('reset/password', [ForgotPasswordController::class, 'resetIndex'])->name('reset.Index');
    Route::post('password/reset', [ForgotPasswordController::class, 'sendResetLink'])->name('password.reset');
    Route::middleware('auth:sanctum')->group(function () {
        // Pengawas Routes
        Route::middleware('pengawas')->group(function () {
            Route::get('/users', [AuthController::class, 'indexUsers'])->name('indexUsers.post');
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
        Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
        Route::get('/profile', [AuthController::class, 'me']);
        Route::get('/home', [HomeController::class, 'home'])->name('home.index');

        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
        Route::post('/maintenance/post', [MaintenanceController::class, 'store'])->name('maintenance.post');
        Route::delete('/maintenance/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
    });
});


// Auth::routes();

// Route::middleware(['auth', 'user-role:admin'])->group(function () {

//     Route::get("/admin/home", [HomeController::class, 'adminHome'])->name("admin.home");
// });
// Route::middleware(['auth', 'user-role:pengawas'])->group(function () {

//     Route::get("/editor/home", [HomeController::class, 'editorHome'])->name("editor.home");
// });

// Route::middleware(['auth', 'user-role:pelaksana'])->group(function () {

//     Route::get("/home", [HomeController::class, 'userHome'])->name("home");
// });
