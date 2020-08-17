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
    // $result = Package::all()->map(fn($item) => $item->package_id)->toArray();
    // $result = CustomerPackage::where('customer_id', 1)->where('customer_package_status', 'active')->pluck('customer_package_id');
    $result = Branch::where('branch_id', 10)->exists();
    dd($result);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::livewire('/newaccount', 'salon.add-new-customer')->name('new-customer'); // amazing

    Route::get('/admin', [AdminDashboard::class, 'index'])->name('admin');

    Route::get('/profile', [Profile::class, 'index'])->name('profile');
});

Auth::routes();
