<?php

use App\Http\Controllers\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/test', function ()
{
    $result = 'Chasing my Magnum Opus - VERnt';
    dd($result);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::livewire('/newaccount', 'salon.add-new-customer')->name('new-customer'); // amazing
    Route::livewire('/customervisits/{customer_package_id}', 'salon.add-customer-visits')->name('customer-visits'); // amazing
    Route::livewire('/customerrenew/{encrypted_customer_id}', 'salon.customer-renew')->name('customer-renew'); // amazing

    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin');

    Route::get('/profile', [Profile::class, 'index'])->name('profile');
});

Auth::routes();
