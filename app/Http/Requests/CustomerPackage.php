<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerPackage extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'branch_id' => ['required', 'integer'],
            'reference_no' => ['required', 'max:30', 'unique:customer_package,reference_no'],
            'payment_type' => ['required', 'in:' . implode(',', config('constant.payment_options'))],
            'package_id' => ['required', 'integer'],
        ];
    }
}
