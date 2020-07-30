<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form">

    @livewire('admin.admin-actions')

        <div class="alert alert-primary w-100 mt-3" role="alert" wire:loading>
            Loading...
        </div>

        <div class="mt-4" wire:loading.remove>
            <div class="address-form">
                <h6 class="text-center text-primary text-bold">
                    <span class="icon icon__location--violet mr-0 align-bottom"></span>
                    ADDRESS
                </h6>

                <form method="POST" id="frm-branch">
                    @csrf
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Branch Name</small>
                        <input type="text" class="form-control border-primary @if($action === 'addBranch') active-field @endif" aria-describedby="branchName"
                    placeholder="Enter Branch Name" name="branch_name" value="{{ $branchName }}"
                    @if($action === 'readBranch' ) disabled @endif>
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Branch Address</small>
                        <input type="text" class="form-control border-primary @if($action === 'addBranch') active-field @endif" aria-describedby="branchAddress"
                    placeholder="Enter Branch Address" name="branch_address" value="{{ $branchAddress }}"
                        @if($action==='readBranch' )disabled @endif>
                    </div>
                </form>
            </div>
        </div>
        {{-- Address Form --}}

        <div class="mt-4" wire:loading.remove>

            @forelse($branchUsers as $user)
                <div class="user-form">
                    <h6 class="text-center text-primary text-bold">
                        <span class="icon icon__account--violet mr-0 align-bottom"></span>
                        USERS
                    </h6>

                    <form method="POST" id="frm-branch-user">
                        @csrf
                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                            <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="First Name"
                                value="{{ $user->first_name }}" @if($action === 'readBranch') disabled @endif />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                            <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Last Name"
                                value="{{ $user->last_name }}" @if($action === 'readBranch') disabled @endif />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                            <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}"
                                readonly />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                            <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email"
                                value="{{ $user->mobile_number }}" @if($action === 'readBranch') disabled @endif />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                            <select class="custom-select border-primary" @if($action === 'readBranch') disabled @endif>
                                @forelse($roles as $role)
                                    <option value="{{ $role['role_id'] }}"
                                        @if($role['role_id']===$user['role_id']) selected @endif>
                                        {{ ucfirst($role['name']) }}</option>
                                @empty
                                    <option readonly disabled> No data.. </option>
                                @endforelse
                            </select>
                        </div>
                    </form>

                </div>
            @empty
                <h6>No User Yet</h6>
            @endforelse

        </div>
        {{-- Branch Users --}}

</div>