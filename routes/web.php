<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomFilterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KilometerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\serviceController;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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
    Route::post('/view-pdf', [MaintenanceController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/tes', [MaintenanceController::class, 'tes'])->name('tes.fitur');
    Route::get('/errorpage', [AuthController::class, 'errorPage'])->name('auth.errors');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.loginIndex');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/registers', [AuthController::class, 'showRegistrationForm'])->name('auth.registerIndex');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('reset/password', [ForgotPasswordController::class, 'resetIndex'])->name('reset.Index');
    Route::post('password/reset', [ForgotPasswordController::class, 'sendResetLink'])->name('password.reset');
    Route::middleware('auth:sanctum')->group(function () {
        //Admin Routes
        Route::get('/custom-filter', [CustomFilterController::class, 'index'])->name('custom-filter.index');
        Route::get('/users', [HomeController::class, 'home'])->name('users.users');
        Route::get('/parts', [PartController::class, 'index'])->name('parts.parts');
        Route::delete('users/delete', [AuthController::class, 'destroyUser'])->name('delete.user');

        Route::middleware('Admin')->group(function () {
            Route::get('/users/post', [AuthController::class, 'indexUsers'])->name('indexUsers.post');
        });

        // Pengawas Routes
        Route::middleware('Pengawas')->group(function () {
            // Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
            // Define pengawas-only routes here
            Route::get('/pengawas', function () {
                return 'Pengawas Dashboard';
            });
        });

        // Pelaksana Routes
        Route::middleware('Pelaksana')->group(function () {
            // Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
            // Define pelaksana-only routes here
            Route::get('/pelaksana', function () {
                return 'Pelaksana Dashboard';
            });
        });
        Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
        Route::get('/profile', [AuthController::class, 'me']);

        //maintenance
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
        Route::post('/maintenance/post', [MaintenanceController::class, 'store'])->name('maintenance.post');
        Route::delete('/maintenance/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

        //parts
        // Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
        Route::get('/part/create', [PartController::class, 'create'])->name('part.create');
        Route::post('/part/post', [PartController::class, 'store'])->name('part.post');
        Route::delete('/part/{part}', [PartController::class, 'destroy'])->name('part.destroy');

        //kilometer
        Route::get('/kilometer', [KilometerController::class, 'index'])->name('kilometer.kilometer');
        Route::get('/kilometer/create', [KilometerController::class, 'create'])->name('kilometer.create');
        Route::post('/kilometer/post', [KilometerController::class, 'store'])->name('kilometer.post');
        Route::delete('/kilometer/{kilometer}', [KilometerController::class, 'destroy'])->name('kilometer.destroy');

        //service time
        Route::get('/service', [serviceController::class, 'index'])->name('service.index');
        Route::delete('/service/{serviceTimes}', [serviceController::class, 'destroy'])->name('service.destroy');
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
