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
              <select name="role_id" id="role-id" class="form-control w-50" required>
                  @forelse ($roles as $role)
                    <option value="{{$role->role_id}}">{{$role->name}}</option>
                  @empty
                    <option readonly>No Roles</option>
                  @endforelse
              </select>
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

{{-- Use Livewire for sending the user to the baskend --}}