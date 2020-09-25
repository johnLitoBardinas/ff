<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form" id="admin-branches-form">

    <div x-data="{
        branchName: '{{$branchName}}',
        branchAddress: '{{$branchAddress}}',
        action: '{{$action}}',
        branchId: '{{$currentBranchId}}',
        users: JSON.parse({{json_encode($branchUsers)}}),
        roles: JSON.parse({{json_encode($roles)}})
    }">

    <template x-if="branchId != '0' && roles.length > 0 ">
        <form id="frm-branch" method="POST" novalidate :class="{ 'd-none': branchId === 0 }">
            @csrf
            <input type="hidden" name="action" x-bind:value="action">
            <input type="hidden" name="current_branch_id" x-bind:value="branchId">
            <div class="d-flex justify-content-end position-relative admin-action">

                <a href="javascript:void(0);"
                class="btn btn-sm btn-default border btn__ff--primary btn-icon btn-icon__delete position-absolute l-0 d-none"
                data-branchid="{{$currentBranchId}}"
                {{-- :class="{ 'd-flex' : action === 'editBranch' }" --}}
                title="Click Here to Remove the Branch."
                id="btn-destroy-branch"
                >DELETE</a>

                <div class="d-flex justify-content-around">

                    <a href="javascript:void(0);"
                    class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__deactivate d-none"
                    :class="{ 'd-flex' : action === 'editBranch' }"
                    data-branchid="{{$currentBranchId}}"
                    data-action="{{ $branchStatus === 'active' ? 'inactive' : 'active' }}"
                    id="btn-branch-status">@if($branchStatus === 'active') DEACTIVATE @else ACTIVATE @endif</a>

                    <button
                    class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save d-none"
                    :class="[ action === 'editBranch' ? 'd-flex' : '' ]"
                    id="btn-savebranch">
                    SAVE
                    </button>

                    <a href="javascript:void(0);"
                    title="Add User to the Branch."
                    class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__adduser d-none"
                    :class="{ 'd-flex': action === 'readBranch' }"
                    id="btn-branch-user"
                    data-branchid="{{$currentBranchId}}"
                    data-branchname="{{$branchName}}">ADD USER</a>

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

                    <div class="form-group">
                        <small for="branchName" class="form-text text-muted">Branch Name</small>
                        <input
                        type="text"
                        class="form-control border-primary"
                        aria-describedby="branchName"
                        placeholder="Enter Branch Name"
                        name="branch_name"
                        :disabled="action === 'readBranch'"
                        :value="branchName"
                        required />
                    </div>

                    <div class="form-group">
                        <small for="branchAddress" class="form-text text-muted">Branch Address</small>
                        <input
                        type="text"
                        class="form-control border-primary"
                        aria-describedby="branchAddress"
                        placeholder="Enter Branch Address"
                        name="branch_address"
                        :disabled="action === 'readBranch'"
                        :value="branchAddress"
                        required />
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
                            <small for="firstName" class="form-text text-muted">First Name</small>
                            <input
                            type="text"
                            class="form-control border-primary"
                            aria-describedby="firstName"
                            placeholder="First Name"
                            name="first_name"
                            :disabled="action === 'readBranch'"
                            :value="user.first_name"
                            required />
                        </div>

                        <div class="form-group">
                            <small for="lastName" class="form-text text-muted">Last Name</small>
                            <input
                            type="text"
                            class="form-control border-primary"
                            aria-describedby="lastName"
                            placeholder="Last Name"
                            name="last_name"
                            :disabled="action === 'readBranch'"
                            :value="user.last_name"
                            required />
                        </div>

                        <div class="form-group">
                            <small for="emailAddress" class="form-text text-muted">Email</small>
                            <input
                            type="email"
                            class="form-control border-primary"
                            aria-describedby="emailAddress"
                            placeholder="Enter email"
                            name="email"
                            :readonly="action === 'editBranch' || action === 'readBranch'"
                            :value="user.email"
                            readonly />
                        </div>

                        <div class="form-group">
                            <small for="mobileNumber" class="form-text text-muted">Mobile</small>
                            <input
                            type="text"
                            class="form-control border-primary"
                            aria-describedby="mobileNumber"
                            placeholder="Enter email"
                            name="mobile_number"
                            :disabled="action === 'readBranch'"
                            :value="user.mobile_number"
                            data-parsley-minlength-message=" "
                            data-parsley-maxlength-message="The field allowed length is 11"
                            minlength="11"
                            maxlength="11"
                            data-parsley-type="number"
                            required />
                        </div>

                        <div class="form-group">
                            <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                            <select
                            class="custom-select border-primary"
                            :disabled="action === 'readBranch'" name="role_id" :value="user.role_id" required >
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

        {{-- @livewire('admin.modal-user-form', [
            'roles' => json_decode($roles),
            'branchId' => $currentBranchId,
            'branchName' => $branchName,
        ]) --}}


    {{-- Modal --}}
    <div class="modal fade" id="modal-user-form" tabindex="-1" role="dialog" aria-labelledby="ModalUserForm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-title">Add User to <u><b id="modal-user-form__branch-name"></b></u></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" id="frm-branch-users" novalidate>
                @csrf
                <input type="hidden" name="branch_id" id="modal-user-form__branch-id">
                <div class="form-group">
                    <label for="first_name" class="col-form-label">First Name:</label>
                    <input type="text" class="form-control" id="first-name" name="first_name" placeholder="First Name" data-parsley-required-message="The field is Required." required />
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Last Name" data-parsley-required-message="The field is Required." required />
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control" id="user-email" name="email" placeholder="Email" data-parsley-required-message="The field is Required." required />
                </div>
                <div class="form-group">
                    <label for="mobile_number" class="col-form-label">Mobile Number:</label>
                    <input type="number" class="form-control" id="mobile-number" name="mobile_number" placeholder="Mobile Number" data-parsley-minlength-message=" " data-parsley-maxlength-message="The field allowed length is 11" minlength="11" maxlength="11" data-parsley-type="number" required />
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Role:</label>
                  @if ( ! empty(json_decode($roles)) )
                    <select name="role_id" id="role-id" class="form-control w-50" required>
                        @forelse (json_decode($roles) as $role)
                        <option value="{{$role->role_id}}">{{$role->name}}</option>
                        @empty
                        <option readonly>No Roles</option>
                        @endforelse
                    </select>
                  @endif
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-default bg-primary text-white" id="btn-save-branch-user">Save</button>
            </div>
          </div>
        </div>
    </div>

    </template>
    </div>

</div>

