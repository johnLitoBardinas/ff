<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/test', function ()
{
    dd('Win the Fucking Life with VERnt..');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin');

    Route::get('/profile', function () {
        echo 'Profile here';
    })->name('profile');
});

Auth::routes([
    'register' => false,
]);
