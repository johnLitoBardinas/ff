<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\User as RequestsUser;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{

    protected $superAdminEmail = 'sadmin@ff.com';
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
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make(config('constant.default_user_password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'mobile_number' => $request->input('mobile_number'),
            'branch_id' => $request->input('branch_id'),
            'role_id' => $request->input('role_id'),
        ]);

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

        if ($request->has('email') && $user->email !== $request->email) {
            $user->email = request('email');
        }

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

    /**
     * Update Non Super Admin email using Super Admin.
     */
    public function updateEmail(Request $request, User $user)
    {

        if ($this->getSuperAdmin()->user_id === intval($request->input('user_id'))) {
            return $this->errorResponse('Invalid Action.', 422);
        }

        // Check if the super admin is the one trying to update return 422 unprocess entity
        if (! $this->isSuperAdmin(request('sadmin'))) {
            return $this->errorResponse('Invalid Action.', 422);
        }

        $this->validate($request, [
            'email' => 'required|email|unique:user,email',
        ]);

        $user->email = request('email');

        if (! $user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();
        return $this->showOne($user);
    }

    private function isSuperAdmin(string $encryptedEmail)
    {
        $decryptedEmail = decrypt($encryptedEmail);
        return $decryptedEmail === $this->superAdminEmail;
    }

    private function getSuperAdmin()
    {
        return User::whereEmail($this->superAdminEmail)->first();
    }
}
