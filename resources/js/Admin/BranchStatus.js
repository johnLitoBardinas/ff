import Swal from 'sweetalert2';

export default class BranchStatus {

    constructor() {
        // register handler
        this.deactivateBranch();
    }

    deactivateBranch() {
        $('.admin-branches-form').on('click', '#btn-branch-status', (e) => {
            const branchId = e.target.dataset.branchid || 0;
            const branchAction = e.target.dataset.action.toUpperCase();

            console.log('branchId', branchId);
            console.log('branchAction', branchAction.toLowerCase());
            return;
            if ( branchId > 0 )  {
                Swal.fire({
                    title: 'Warning',
                    text: `Are you sure to ${branchAction} branch?`,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonColor: '#463291',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                  }).then((result) => {
                    if (result.value) {
                      // fire some axios ajax here create the api endpoint for this one
                      // Swal.fire(
                      //   'Deleted!',
                      //   'Your file has been deleted.',
                      //   'success'
                      // )
                    }
                  })
            }

        });
        // handler for deactivation or activating branch
    }

}