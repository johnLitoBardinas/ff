{{-- {{ dd( compact('currentBranch', 'branchAddress') ) }} --}}
{{-- {{ dd($municipalities) }} --}}
<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form'">

    <div class="mt-4 address-form">
        <h6 class="text-center text-primary text-bold">
            <span class="icon icon__location--violet mr-0 align-bottom"></span>
            ADDRESS
        </h6>

        <form>
            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Unit no./Floor no./Building
                    Name/Street</small>
                <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Unit no./Floor no./Building Name/Street"
                    value="{{ $currentBranch['branch_address'] }}">
            </div>

            <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Region</small>
                {{-- <span>Region Code: {{ $currentRegionCode }}</span> --}}
                <select class="custom-select border-primary" wire:model="currentRegionCode">
                    <?= $regions; ?>
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Province</small>
                {{-- <span>Province Code: {{ $currentProvinceCode }}</span> --}}
                <select class="custom-select border-primary" wire:model="currentProvinceCode">
                    <?= $provinces; ?>
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Municipality</small>
                {{-- <span>Municipality Code: {{ $currentMunicipalityCode }}</span> --}}
                <select class="custom-select border-primary" wire:model="currentMunicipalityCode">
                   <?= $municipalities; ?>
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Barangay</small>
                {{-- <span>Barangay Code livewire: {{ $currentBrgyPcgcCode }}</span> --}}
                <select class="custom-select border-primary" wire:model="currentBrgyPcgcCode">
                    <?= $barangay; ?>
                </select>
            </div>

        </form>

    </div>
    {{-- Address Form Field --}}

    <div class="mt-4 user-form">

        @forelse($currentBranch['user'] as $user)

            <h6 class="text-center text-primary text-bold">
                <span class="icon icon__account--violet mr-0 align-bottom"></span>
                USERS
            </h6>

            <form class="user-{{ $loop->index }}">
                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                    <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="First Name"
                        value="{{ $user['first_name'] }}">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                    <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Last Name"
                        value="{{ $user['last_name'] }}">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                    <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email" readonly
                        value="{{ $user['email'] }}">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                    <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email"
                        value="{{ $user['mobile_number'] }}">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                    <select class="custom-select border-primary">
                        @forelse($roles as $role)
                            <option value="{{ $role['role_id'] }}"
                                data-index="{{ $loop->index }}" @if($role['role_id']===$user['role_id']) selected
                                @endif>{{ ucfirst($role['name']) }}</option>
                        @empty
                            <option readonly disabled> No data.. </option>
                        @endforelse
                    </select>
                </div>

            </form>

        @empty
            <h6>No User Yet</h6>
        @endforelse

    </div>
    {{-- User Form Field --}}

</div>
