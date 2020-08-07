<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:user,email'],
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'mobile_number' => ['required', 'string', 'max:11'],
            'branch_id' => ['required'],
            'role_id' => ['required']
        ];
    }
}
