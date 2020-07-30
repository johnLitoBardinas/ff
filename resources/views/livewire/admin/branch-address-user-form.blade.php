<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form" x-data="{ action: '{{$action}}' }">
    BranchAddressUserForm = {{ $action }}
    <form id="frm-branch" method="POST">
        @csrf
        <input type="hidden" name="action" x-bind:value="action">
        <div class="d-flex justify-content-end position-relative admin-action">
        Alphine - <span x-text="action"></span>
            <a href="javascript:void(0);" class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0 d-none">DELETE</a>

            <div class="d-flex justify-content-around">

                <a href="javascript:void(0);"
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none"
                :class="{ 'd-flex' : action === 'editBranch' }">DEACTIVATE</a>

                <a href="javascript:void(0);"
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-none"
                :class="[ (action === 'editBranch') || (action === 'addBranch') ? 'd-flex' : '' ]"
                id="btn-savebranch">SAVE</a>

                <a href="javascript:void(0);"
                title="Add User to the Branch."
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser d-none"
                :class="{ 'd-flex': action === 'readBranch' }">ADD USER</a>

                <a href="javascript:void(0);"
                title="Edit Branch."
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-none"
                :class = "{ 'd-flex': action === 'readBranch' }"
                x-on:click="action = 'editBranch'"
                wire:click="editBranch">EDIT</a>

                <a href="javascript:void(0);"
                title="Click to Exit."
                class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none"
                :class="[ (action === 'addBranch') || (action === 'editBranch') ? 'd-flex' : '' ]"
                x-on:click="action = 'readBranch'"
                wire:click="exit">EXIT</a>
            </div>
        </div>

        <div class="alert alert-primary w-100 mt-3" role="alert" wire:loading>
            Loading...
        </div>

        <div class="mt-4" wire:loading.remove>
            <div class="address-form">
                <h6 class="text-center text-primary text-bold">
                    <span class="icon icon__location--violet mr-0 align-bottom"></span>
                    ADDRESS
                </h6>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Name</small>
                    <input type="text" class="form-control border-primary" aria-describedby="branchName"
                    :disabled="action === 'readBranch'"
                placeholder="Enter Branch Name" name="branch_name" value="{{ $branchName }}" />
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Address</small>
                    <input type="text" class="form-control border-primary"
                    :disabled="action === 'readBranch'" aria-describedby="branchAddress"
                placeholder="Enter Branch Address" name="branch_address" value="{{ $branchAddress }}" />
                </div>
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

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                            <input type="text" class="form-control border-primary"
                            :disabled="action === 'readBranch'"
                        aria-describedby="emailHelp" placeholder="First Name" value="{{$user['first_name']}}" />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                            <input type="text" class="form-control border-primary"
                            :disabled="action === 'readBranch'"
                                aria-describedby="emailHelp" placeholder="Last Name" value="{{$user['last_name']}}" />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                            <input type="email" class="form-control border-primary"
                            :disabled="action === 'readBranch'"
                                aria-describedby="emailHelp" placeholder="Enter email" value="{{$user['email']}}" readonly />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                            <input type="text" class="form-control border-primary"
                            :disabled="action === 'readBranch'"
                                aria-describedby="emailHelp" placeholder="Enter email" value="{{$user['mobile_number']}}" />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                            <select class="custom-select border-primary"
                            :disabled="action === 'readBranch'" >
                                @forelse($roles as $role)
                                    <option value="{{ $role['role_id'] }}"
                                        @if($role['role_id']===$user['role_id']) selected @endif>
                                        {{ ucfirst($role['name']) }}</option>
                                @empty
                                    <option readonly disabled> No data.. </option>
                                @endforelse
                            </select>
                        </div>
                </div>
            @empty
                <h6>No User Yet</h6>
            @endforelse

        </div>
        {{-- Branch Users --}}
    </form>
</div>

{{--
    This form will serve as a edit / Deactivate and Destroy.
--}}