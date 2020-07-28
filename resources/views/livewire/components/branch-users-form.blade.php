<div>
    <h6 class="text-center text-primary text-bold">
        <span class="icon icon__account--violet mr-0 align-bottom"></span>
        USERS
    </h6>

    <form>
        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="First Name" />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Last Name</small>
            <input type="text" class="form-control border-primary" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Last Name" />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Email</small>
            <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email" readonly />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">Mobile</small>
            <input type="email" class="form-control border-primary" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email" />
        </div>

        <div class="form-group">
            <small for="exampleInputEmail1" class="form-text text-muted">User Type</small>
            <select class="custom-select border-primary">
                {{-- @if($role['role_id']===$user['role_id']) selected @endif --}}
                @forelse($roles as $role)
                    <option value="{{ $role['role_id'] }}">{{ ucfirst($role['name']) }}</option>
                @empty
                    <option readonly disabled> No data.. </option>
                @endforelse
            </select>
        </div>
    </form>

</div>
