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

    // Admin Side.
    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin')->middleware('can:access-admin');

    Route::livewire('/packages', 'admin.packages')->name('packages')->middleware('can:access-admin');
    Route::livewire('/addnewpackage/{type}', 'admin.add-new-package')->name('add-package')->middleware('can:access-admin');

    // Open new Customer
    Route::livewire('/newaccount', 'salon.add-new-customer')->name('new-customer')->middleware('can:access-management');
    Route::livewire('/customervisits/{customer_package_id}/{package_type}', 'salon.add-customer-visits')->name('customer-visits')->middleware('can:access-management');
    Route::livewire('/customerrenew/{encrypted_customer_id}', 'salon.customer-renew')->name('customer-renew')->middleware('can:access-management');

    // Manager/Cashier Side.
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('can:access-management');

    // User Profile
    Route::get('/profile', [Profile::class, 'index'])->name('profile')->middleware('can:access-user');
});

Auth::routes();
