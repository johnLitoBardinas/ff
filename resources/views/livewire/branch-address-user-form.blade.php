{{-- {{ dd( compact('currentBranch', 'regions', 'provinces', 'municipalities','barangay') ) }} --}}
{{-- {{ dd( $regions ) }} --}}
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
                    aria-describedby="emailHelp" placeholder="Unit no./Floor no./Building Name/Street"
                    value="{{ $currentBranch['branch_address'] }}">
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Region</small>
                <select class="custom-select border-primary">
                    @forelse($regions as $region)
                        <option value="{{ $region['region_code'] }}" @if( $region['region_code'] ===
                            $currentBranch['region']['region_code'] ) selected @endif>{{ $region['region_name'] }}
                        </option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Province</small>
                <select class="custom-select border-primary">
                    @forelse($provinces as $province)
                        <option value="{{ $province['province_code'] }}" @if( $province['province_code'] ===
                            $currentBranch['province']['province_code'] ) selected
                            @endif>{{ $province['province_name'] }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Municipality</small>
                <select class="custom-select border-primary">
                    @forelse($municipalities as $municipality)
                        <option value="{{ $municipality['municipality_code'] }}" @if( $municipality['municipality_code'] === $currentBranch['municipality']['municipality_code']) selected @endif>
                            {{ $municipality['municipality_name'] }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Barangay</small>
                <select class="custom-select border-primary">
                    @forelse($barangay as $brgy)
                        <option value="{{ $brgy['psgc_code'] }}" @if($brgy['psgc_code'] === $currentBranch['barangay']['psgc_code']) selected @endif>{{ $brgy['barangay_name'] }}</option>
                    @empty
                        <option readonly disabled>No Available Data</option>
                    @endforelse
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
