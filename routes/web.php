<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['PreventBackHistory'])->group(function () {

    Auth::routes();

    Route::middleware(['auth'])->group(function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
            Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
            Route::get('setting', [AdminController::class, 'setting'])->name('admin.setting');
        });

        Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
            Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
            Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
            Route::get('setting', [UserController::class, 'setting'])->name('user.setting');
        });
    });
});
