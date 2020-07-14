<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin', function () {

        echo '<h1>This is the Admin <b>InProgress!!</b></h1>';

    })->name('admin');

    Route::get('/profile', function () {
        echo 'Profile here';
    })->name('profile');
});

Auth::routes();
