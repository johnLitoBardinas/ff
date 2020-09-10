<?php

namespace App\Http\Requests;

use App\Enums\BranchType;
use Illuminate\Foundation\Http\FormRequest;

class Package extends FormRequest
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
            'package_name' => ['required', 'unique:package,package_name', 'string'],
            'package_price' => ['required', 'string', 'min:1', 'max:9'],
            'package_type' => ['required', 'in:' . implode(',', BranchType::getValues())],
            'salon_no_of_visits' => ['required', 'max:10', 'min:1', 'integer'],
            'salon_days_valid_count' => ['required', 'max:365', 'min:1', 'integer'],
            'gym_no_of_visits' => ['required', 'max:10', 'min:0', 'integer'],
            'gym_days_valid_count' => ['required', 'max:365', 'min:1', 'integer'],
            'spa_no_of_visits' => ['required', 'max:10', 'min:1', 'integer'],
            'spa_days_valid_count' => ['required', 'max:365', 'min:1', 'integer'],
        ];
    }

}
