<?php

use App\Branch;
use App\Package;
use App\Customer;
use App\CustomerPackage;
use App\Http\Controllers\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/test', function ()
{
    $customer = Customer::find(1);
    foreach ($customer->packages as $package) {
        dump($package->pivot->reference_no);
    }
    // ddd();
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::livewire('/newaccount', 'salon.add-new-customer')->name('new-customer'); // amazing

    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin');

    Route::get('/profile', [Profile::class, 'index'])->name('profile');
});

Auth::routes();
