<div class="col-md-5 offset-md-1 vh-59 overflow-y-scroll chrome-hide-scroll admin-branches-form'">

    <div class="mt-4 address-form">
        <h6 class="text-center text-primary text-bold">
            <span class="icon icon__location--violet mr-0 align-bottom"></span>
            ADDRESS
        </h6>

        <form>
            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Branch Name</small>
                <input type="text" class="form-control border-primary"
                aria-describedby="emailHelp" placeholder="Branch Name">
            </div>
            <div class="form-group">
                <small for="exampleInputEmail1" class="form-text text-muted">Branch Address</small>
                <input type="text" class="form-control border-primary"
                aria-describedby="emailHelp" placeholder="Branch Address">
            </div>
        </form>

    </div>

    <div class="mt-4 user-form">

        @forelse($branchUsers as $user)

            <h6 class="text-center text-primary text-bold">
                <span class="icon icon__account--violet mr-0 align-bottom"></span>
                USERS
            </h6>

            <form class="user-{{ $loop->index }}">
                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
                    <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="First Name">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
                    <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Last Name">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
                    <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
                    <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
                    <select class="custom-select border-primary" x-bind:disabled="action !== 'editBranch'">
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