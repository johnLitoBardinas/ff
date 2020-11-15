<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

class SuperAdminController extends ApiController
{
    private function isSuperAdmin(string $encryptedEmail)
    {
        $decryptedEmail = decrypt($encryptedEmail);
        return $decryptedEmail === config('constant.super_admin_email');
    }

    private function getSuperAdmin()
    {
        return User::whereEmail(config('constant.super_admin_email'))->first();
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
}
