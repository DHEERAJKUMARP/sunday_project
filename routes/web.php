<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});