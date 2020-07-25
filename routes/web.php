<?php

use App\Region;
use App\Municipality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/test', function ()
{
    // Quick Testing
    // $result = DB::table('region')->where('id', '>', '0')->pluck('id')->toArray();
    // $result = Province::with('municipality')->orderBy('province_name')->get()->toArray();
    // $result = Municipality::orderBy('municipality_name')->with(['barangay' => fn($query) => $query->orderBy('barangay_name') ])->get()->toArray();
    $result = Region::where('region_code', '05')->with('province.municipality.barangay')->get()->toArray();
    dd($result);
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
