<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form" x-data="brancUser">

    @livewire('admin.admin-actions', compact('currentBranchId') )

    <div class="mt-4">
        <div class="address-form">
            <h6 class="text-center text-primary text-bold">
                <span class="icon icon__location--violet mr-0 align-bottom"></span>
                ADDRESS
            </h6>

            <form>
                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Name</small>
                    <input type="text" class="form-control border-primary" aria-describedby="branchName" placeholder="Enter Branch Name" wire:model="branchName">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Address</small>
                    <input type="text" class="form-control border-primary"
                        aria-describedby="branchAddress" placeholder="Enter Branch Address" wire:model="branchAddress">
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">

        @forelse($currentBranch['user'] as $user)
            <div class="user-form">
                <h6 class="text-center text-primary text-bold">
                    <span class="icon icon__account--violet mr-0 align-bottom"></span>
                    USERS
                </h6>

                <form>
                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="First Name" value="{{ $user->first_name }}" />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                        <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Last Name" value="{{ $user->last_name }}" />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}"readonly />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                        <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->mobile_number }}" />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                        <select class="custom-select border-primary">
                            @forelse($roles as $role)
                                <option value="{{ $role['role_id'] }}" @if($role['role_id']===$user['role_id']) selected @endif>{{ ucfirst($role['name']) }}</option>
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


</div>

<script>
    function branchUser() {
        return {

        };
    }
</script>
