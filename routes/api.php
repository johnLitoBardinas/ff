<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

Route::get('/', function (Request $request)
{
    $environment = App::environment();
    dd($environment);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request)
{
    $data = $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $user = User::whereEmail($request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response([
            'email' => ['The provided credentials are incorrect.'],
        ], 422);
    }

    return $user->createToken('my-token')->plainTextToken;

});

// Branch Resource Endpoint.
Route::resource('branch', 'BranchController', ['except' => ['index', 'create', 'edit'] ] );
Route::put('/branch/status/{branch}/{status}', [BranchController::class, 'updateBranchStatus']);

// User Resource Endpoint
Route::resource('users', 'UserController', ['except' => ['create', 'edit'] ] );