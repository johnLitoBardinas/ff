<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll">

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
                    aria-describedby="emailHelp" placeholder="Unit no./Floor no./Building Name/Street" wire:model="currentBranch.branch_address">
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Region</small>
                <select class="custom-select border-primary">
                    @forelse($regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->region_name }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Province</small>
                <select class="custom-select border-primary">
                    @forelse($provinces as $province)
                        <option value="{{ $province->province_code }}">{{ $province->province_name }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Municipality</small>
                <select class="custom-select border-primary">
                    @forelse($municipalities as $municipality)
                        <option value="{{ $municipality->municipality_code }}">{{ $municipality->municipality_name }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Barangay</small>
                <select class="custom-select border-primary">
                    @forelse($barangay as $brgy)
                        <option value="{{ $brgy->psgc_code }}">{{ $brgy->barangay_name }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

        </form>

    </div>
    {{-- Address Form Field --}}

    <div class="mt-4 user-form">
        <h6 class="text-center text-primary text-bold">
            <span class="icon icon__account--violet mr-0 align-bottom"></span>
            USERS
        </h6>

        <form>
            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="First Name" value="John Lito">
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Last Name" value="Bardinas">
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" value="johnLito1996@gmail.com">
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" value="(+63) 9123456789">
            </div>

            {{-- Branch will be AutoResolved upon selecting by user. --}}
            {{-- <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Branch</small>
                <select class="custom-select border-primary">
                    <option value="1">Branch 1</option>
                    <option value="1">Branch 2</option>
                </select>
            </div> --}}

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                <select class="custom-select border-primary">
                    <option value="1">Branch Manager</option>
                    <option value="1">Branch Cashier</option>
                </select>
            </div>

        </form>

    </div>
    {{-- User Form Field --}}

</div>
