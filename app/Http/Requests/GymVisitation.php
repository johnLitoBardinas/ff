<?php

namespace App\Http\Requests;

use App\Enums\GymVisitationType;
use App\Rules\IsBranchActive;
use App\Rules\IsBranchGymType;
use App\Rules\IsBranchIdExist;
use App\Rules\IsCustomerPackageGymServiceActive;
use App\Rules\IsUserActiveById;
use App\Rules\IsUserIdExist;
use App\Rules\IsUserInGymTypeBranch;
use Illuminate\Foundation\Http\FormRequest;

class GymVisitation extends FormRequest
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
            'customer_package_id' => [
                'required',
                new IsCustomerPackageGymServiceActive(),
            ],
            'current_branch' => [
                'required',
                new IsBranchIdExist(),
                new IsBranchActive(),
                new IsBranchGymType(),
            ],
            'user_id' => [
                'required',
                new IsUserIdExist(),
                new IsUserActiveById(),
                new IsUserInGymTypeBranch(),
            ],
            'visitation_type' => [
                'required',
                'in:' . implode(',', GymVisitationType::getValues()),
            ],
        ];
    }
}
