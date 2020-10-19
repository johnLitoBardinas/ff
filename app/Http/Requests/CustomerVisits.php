<?php

namespace App\Http\Requests;

use App\Enums\PackageType;
use App\Repositories\CustomerVisitsRepository;
use App\Rules\IsUserIdExist;
use App\Rules\IsBranchIdExist;
use App\Rules\IsCustomerHasPackage;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsCustomerPackageAvailableToVisit;

class CustomerVisits extends FormRequest
{
    protected $customerVisitsRepository;

    public function __construct(CustomerVisitsRepository $customerVisitsRepository)
    {
        $this->customerVisitsRepository = $customerVisitsRepository;
    }

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
        $customerId = $this->route('customer')->first()->customer_id;
        $customerPackageId = (int) request('customer_package_id');
        $packageType = request('package_type');

        return [
            'customer_package_id' => [
                'bail',
                'required',
                'integer',
                new IsCustomerHasPackage($customerId, $packageType),
                new IsCustomerPackageAvailableToVisit($this->customerVisitsRepository->customerPackageVisitationLimit($customerPackageId, $packageType))
            ],
            'branch_id' => [
                'required',
                'integer',
                new IsBranchIdExist()
            ],
            'user_id' => [
                'required',
                'integer',
                new IsUserIdExist()
            ],
            'package_type' => [
                'required',
                'string',
                'in:' . implode(',', PackageType::getValues())
            ],
        ];
    }
}
