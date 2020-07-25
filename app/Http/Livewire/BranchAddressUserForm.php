<?php

namespace App\Http\Livewire;

use App\Barangay;
use App\Role;
use App\Branch;
use App\Municipality;
use App\Province;
use App\Region;
use Livewire\Component;

class BranchAddressUserForm extends Component
{
    protected $listeners = ['onChangeBranch' => 'setBranch'];

    // Roles List.
    public $roles;

    // Current Branch Id.
    public $currentBranchId;

    // Current Branch.
    public $currentBranch;

    // Region List Dropdown. HTML
    public $regions;

    // Province List Dropdown. HTML
    public $provinces;

    // Municipalities List Dropdown. HTML
    public $municipalities;

    // Barangay List Dropdown. HTML
    public $barangay;

    // Address ['Region', 'Province', 'Municipality', 'Barangay']
    public $branchAddress;

    // Current Active [Region, Province, Municipality, Brgy]
    public $currentRegionCode;
    public $currentProvinceCode;
    public $currentMunicipalityCode;
    public $currentBrgyPcgcCode;

    public function mount()
    {
        $this->roles = Role::all()->toArray();

        $this->currentBranchId = Branch::orderBy('branch_name')->first()->branch_id;

        $this->setBranch();
        $this->supplySelectAddress();

    }

    /**
     * Getting the Branch ID.
     * Getting the first branch with users + region + province + municipality.
     * Supplied the necessary default RegionCode, ProviceCode, MunicipalityCode, BrgyCode.
     */
    public function setBranch($brandId = null)
    {
        if (! is_null($brandId)) {
            $this->currentBranchId = $brandId;
        }

        $this->setBranchUsingBranchId();
        $this->supplySelectAddress();
    }

    /**
     * Update current RegionCode.
     * Update the Province List.
     */
    public function updatedCurrentRegionCode()
    {
        $this->currentProvinceCode = $this->getAllProvinces()[0]['province_code'];
        $this->currentMunicipalityCode = $this->getAllMunicipalities()[0]['municipality_code'];
        $this->currentBarangay = $this->getAllBarangay()[0]['psgc_code'];

        $this->provinces = renderSelect($this->getAllProvinces(), $this->currentProvinceCode, 'province');
        $this->municipalities = renderSelect($this->getAllMunicipalities(), $this->currentMunicipalityCode, 'municipality');
        $this->barangay = renderSelect($this->getAllBarangay(), $this->currentBrgyPcgcCode, 'barangay');
    }

    /**
     * Update the Current Province Code.
     * Update the Municipalities List.
     */
    public function updatedCurrentProvinceCode()
    {
        $this->provinces = renderSelect($this->getAllProvinces(), $this->currentProvinceCode, 'province');

        $this->currentMunicipalityCode = $this->getAllMunicipalities()[0]['municipality_code'];
        $this->currentBarangay = $this->getAllBarangay()[0]['psgc_code'];

        $this->municipalities = renderSelect($this->getAllMunicipalities(), $this->currentMunicipalityCode, 'municipality');
        $this->barangay = renderSelect($this->getAllBarangay(), $this->currentBrgyPcgcCode, 'barangay');
    }

    /**
     * Using the current Municipality + Province + Region Code
     * Update the Barangay List.
     */
    public function updatedCurrentMunicipalityCode()
    {
        $this->municipalities = renderSelect($this->getAllMunicipalities(), $this->currentMunicipalityCode, 'municipality');

        $this->currentBarangay = $this->getAllBarangay()[0]['psgc_code'];
        $this->barangay = renderSelect($this->getAllBarangay(), $this->currentBrgyPcgcCode, 'barangay');
    }

    public function updatedcurrentBrgyPcgcCode() {
        $this->barangay = renderSelect($this->getAllBarangay(), $this->currentBrgyPcgcCode, 'barangay');
    }

    /**
     * Setting up the current Branch with data and the following properties:
     *
     * currentRegion
     * currentProvince
     * currentMunicipality
     * currentBarangay
     */
    private function setBranchUsingBranchId()
    {
        $this->currentBranch = Branch::where('branch_id', $this->currentBranchId)
            ->with(['user.role', 'region', 'province', 'municipality', 'barangay'])
            ->get()
            ->first()
            ->toArray();

        $this->currentRegionCode = $this->currentBranch['region']['region_code'];
        $this->currentProvinceCode = $this->currentBranch['province']['province_code'];
        $this->currentMunicipalityCode = $this->currentBranch['municipality']['municipality_code'];
        $this->currentBrgyPcgcCode = $this->currentBranch['barangay']['psgc_code'];
    }

    /**
     * Using the $currentRegionCode.
     * Supplying the Region, Province, Municipalities, Barangay with filtered Region Code.
     */
    private function supplySelectAddress()
    {
        $this->regions = renderSelect($this->getAllRegions(), $this->currentRegionCode, 'region');
        $this->provinces = renderSelect($this->getAllProvinces(), $this->currentProvinceCode, 'province');
        $this->municipalities = renderSelect($this->getAllMunicipalities(), $this->currentMunicipalityCode, 'municipality');
        $this->barangay = renderSelect($this->getAllBarangay(), $this->currentBrgyPcgcCode, 'barangay');
    }

    private function getAllRegions()
    {
        return Region::orderBy('region_name')->get()->toArray();
    }

    private function getAllProvinces()
    {
        return Province::where('region_code', $this->currentRegionCode)->get()->toArray();
    }

    private function getAllMunicipalities() {
        return Municipality::where('region_code', $this->currentRegionCode)->where('province_code', $this->currentProvinceCode)->get()->toArray();
    }

    private function getAllBarangay() {
        return Barangay::where('region_code', $this->currentRegionCode)->where('province_code', $this->currentProvinceCode)->where('municipality_code', $this->currentMunicipalityCode)->get()->toArray();
    }

    /**
     * Redering the component.
     */
    public function render()
    {
        return view('livewire.branch-address-user-form');
    }

}
