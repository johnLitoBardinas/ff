<div class="modal fade" id="modal-branch-form" tabindex="-1" role="dialog" aria-labelledby="ModalBranchForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Add new Branch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" id="frm-branch-new" novalidate>
            @csrf
            <div class="form-group">
                <label for="branch_name" class="col-form-label">Branch Name:</label>
                <input type="text" class="form-control" id="branch-name" name="branch_name" placeholder="Branch Name" data-parsley-required-message="The field is Required." required />
            </div>
            <div class="form-group">
                <label for="branch_address" class="col-form-label">Branch Address:</label>
                <input type="text" class="form-control" id="branch-address" name="branch_address" placeholder="Branch Address" data-parsley-required-message="The field is Required." required />
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Branch Type:</label>
              <select name="branch_type" id="branch-type" class="form-control w-50" required>
                  <option value="salon">Salon</option>
                  <option value="gym">Gym</option>
                  <option value="spa">Spa</option>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default bg-primary text-white" id="btn-save-new-branch">Save</button>
        </div>
      </div>
    </div>
</div>