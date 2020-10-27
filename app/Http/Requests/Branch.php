<?php

namespace App\Http\Requests;

use App\Enums\BranchType;
use Illuminate\Foundation\Http\FormRequest;

class Branch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_name' => ['required', 'string', 'unique:branch,branch_name', 'max:50'],
            'branch_address' => ['required', 'string', 'unique:branch,branch_address', 'max:190'],
            'branch_type' => ['required', 'in:' . implode(',', BranchType::getValues())],
        ];
    }
}
