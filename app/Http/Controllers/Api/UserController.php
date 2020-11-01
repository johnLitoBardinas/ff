<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User as RequestsUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsUser $request)
    {
        $userRequest = $request->all();
        $userRequest['password'] = Hash::make(config('constant.default_user_password'));
        $user = User::create($userRequest);
        return $this->showOne($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'email' => 'required|email',
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'mobile_number' => ['required', 'string', 'max:11'],
            'role_id' => 'required',
        ];

        $this->validate($request, $rules);

        if ($request->has('first_name')) {
            $user->first_name = request('first_name');
        }

        if ($request->has('last_name')) {
            $user->last_name = request('last_name');
        }

        if ($request->has('mobile_number')) {
            $user->mobile_number = request('mobile_number');
        }

        if ($request->has('role_id')) {
            $user->role_id = request('role_id');
        }

        if (! $user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();
        return $this->showOne($user);
    }
}
