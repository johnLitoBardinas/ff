<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    // Admin Side.
    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin')->middleware('can:access-admin');

    // Super Admin Settings
    Route::livewire('/supersettings', 'admin.super-admin-settings')->name('settings')->middleware('can:access-superadmin');

    // Packages
    Route::livewire('/packages', 'admin.packages')->name('packages')->middleware('can:access-admin');
    Route::livewire('/addnewpackage/{type}', 'admin.add-new-package')->name('add-package')->middleware('can:access-admin');

    // Open new Customer
    Route::livewire('/newaccount', 'management.add-new-customer')
        ->name('new-customer')
        ->middleware('can:access-management');

    Route::livewire('/customervisits/{customer_package_id}/{package_type}', 'management.add-customer-visits')
        ->name('customer-visits')
        ->middleware('can:access-management');

    Route::livewire('/customerrenew/{encrypted_customer_id}', 'management.customer-renew')
        ->name('customer-renew')
        ->middleware('can:access-management');

    // Manager/Cashier Side.
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('can:access-management');

    // User Profile
    Route::get('/profile', [Profile::class, 'index'])->name('profile')->middleware('can:access-user');
});

Auth::routes();
