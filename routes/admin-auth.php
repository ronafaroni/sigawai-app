<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\UserLoginController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'store']);

});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

});

Route::prefix('web')->middleware('auth:web')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout-user', [UserLoginController::class, 'userDestroy'])->name('admin.logout-user');
});

