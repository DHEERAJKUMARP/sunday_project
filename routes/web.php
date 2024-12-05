<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\office_time\dashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showAuthForm'])->name('register-login'); // Show both forms
Route::post('/register', [AuthController::class, 'register']); // Handle registration
Route::post('/login', [AuthController::class, 'login']); // Handle login


Route::middleware(['auth'])->group(function () {
    // Protected routes
    Route::get('/dashboard', function () {
        return view('home');
    });

    //OFFICE TIME
    Route::get('/office_time', [dashboardController::class, 'index'])->name('office_time');
    Route::post('/create', [dashboardController::class, 'create'])->name('office_time.create');
    Route::resource('entries', dashboardController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});