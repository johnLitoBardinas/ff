<div
class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form"
x-data="{
    branchName: '{{$branchName}}',
    branchAddress: '{{$branchAddress}}',
    action: '{{$action}}',
    branchId: '{{$currentBranchId}}',
    users: JSON.parse({{json_encode($branchUsers)}}),
    roles: JSON.parse({{json_encode($roles)}})
}" @add-new-user="users.push($event.detail)" @reset-new-user="action = 'addBranch'">
PHP: Action = {{$action}}
    <form id="frm-branch" method="POST">
        @csrf
        <input type="hidden" name="action" x-bind:value="action">
        <input type="hidden" name="current_branch_id" x-bind:value="branchId">
        <div class="d-flex justify-content-end position-relative admin-action">
            AP: Action = <span x-text="action"></span>
            <a href="javascript:void(0);" class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0 d-none">DELETE</a>

            <div class="d-flex justify-content-around">

                <a href="javascript:void(0);"
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none"
                :class="{ 'd-flex' : action === 'editBranch' }"
                data-branchid="{{$currentBranchId}}"
                data-action="{{ $branchStatus === 'active' ? 'inactive' : 'active' }}"
                id="btn-branch-status">@if($branchStatus === 'active') DEACTIVATE @else ACTIVATE @endif</a>

                <a href="javascript:void(0);"
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-none"
                :class="[ action === 'editBranch' ? 'd-flex' : '' ]"
                id="btn-savebranch">SAVE</a>

                <a href="javascript:void(0);"
                title="Add User to the Branch."
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser d-none"
                :class="{ 'd-flex': action === 'readBranch' }"
                data-branchid="{{$currentBranchId}}">ADD USER</a>

                <a href="javascript:void(0);"
                title="Edit Branch."
                class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__edit d-none"
                :class = "{ 'd-flex': action === 'readBranch' }"
                x-on:click="action = 'editBranch'"
                wire:click="editBranch">EDIT</a>

                <a href="javascript:void(0);"
                title="Click to Exit."
                class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__exit d-none"
                :class="[ action === 'editBranch' ? 'd-flex' : '' ]"
                x-on:click="action = 'readBranch';"
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

                <span x-text="users.length"></span>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Name</small>
                    <input type="text" class="form-control border-primary" aria-describedby="branchName"
                    :disabled="action === 'readBranch'"
                placeholder="Enter Branch Name" name="branch_name" :value="branchName"/>
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Branch Address</small>
                    <input type="text" class="form-control border-primary"
                    :disabled="action === 'readBranch'" aria-describedby="branchAddress"
                placeholder="Enter Branch Address" name="branch_address" :value="branchAddress"/>
                </div>
            </div>
        </div>
        {{-- Address Form --}}

        <h6 x-show="users.length === 0">No User Yet</h6>
        <div class="mt-4" wire:loading.remove>

            <template x-if="users.length" x-for="(user, index) in users" :key="index">
                <div class="user-form">
                    <h6 class="text-center text-primary text-bold">
                        <span class="icon icon__account--violet mr-0 align-bottom"></span>
                        USERS
                    </h6>

                    <input type="hidden" name="user_id" :value="user.user_id" />
                    <input type="hidden" name="branch_id" :value="branchId" />

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                        <input type="text" class="form-control border-primary"
                        :disabled="action === 'readBranch'"
                        aria-describedby="firstName"
                        placeholder="First Name" name="first_name" :value="user.first_name" />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                        <input type="text" class="form-control border-primary"
                        :disabled="action === 'readBranch'"
                        aria-describedby="lastName"
                        placeholder="Last Name" name="last_name" :value="user.last_name"/>
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                        <input type="email" class="form-control border-primary"
                        :readonly="action === 'editBranch' || action === 'readBranch'"
                            aria-describedby="emailAddress" placeholder="Enter email" name="email" :value="user.email" readonly />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                        <input type="text" class="form-control border-primary"
                        :disabled="action === 'readBranch'"
                        aria-describedby="mobileNumber" placeholder="Enter email" name="mobile_number" :value="user.mobile_number" />
                    </div>

                    <div class="form-group">
                        <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                        <select class="custom-select border-primary"
                        :disabled="action === 'readBranch'" name="role_id" :value="user.role_id">
                            <template x-for="(role, index)  in roles" :key="index">
                                <option :value="role.role_id" x-text="role.name" x-bind:selected="user.role_id == role.role_id"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </template>

        </div>
        {{-- Branch Users --}}
    </form>
</div>
