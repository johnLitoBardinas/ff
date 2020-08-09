<div>
    <form action="POST" id ="">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save">UPDATE PASSWORD</button>
        </div>
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="form-group">
            <small for="old_password" class="form-text text-muted">Old Password</small>
            <input type="text" class="form-control border-primary" aria-describedby="oldPassword" placeholder="Enter Old Password" />
        </div>

        <div class="form-group">
            <small for="new_password" class="form-text text-muted">New Password</small>
            <input type="text" class="form-control border-primary" aria-describedby="newPassword" placeholder="Enter New Password" />
        </div>

        <div class="form-group">
            <small for="confirmPassword" class="form-text text-muted">Last Name</small>
            <input type="text" class="form-control border-primary" aria-describedby="confirmPassword" placeholder="Confirm Password"  />
        </div>
    </form>
</div>
