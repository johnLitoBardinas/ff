const utils = require('../utils');
import Swal from 'sweetalert2';

export default class BranchStatus {

    constructor() {
        this.onChangeBranchStatus();
    }

    onChangeBranchStatus() {

        $('.admin-branches-form').on('click', '#btn-branch-status', (e) => {
            const branchId = e.target.dataset.branchid || 0;
            const branchAction = e.target.dataset.action;

            Swal.fire(utils.swal2Option('warning', 'Warning', `Are you sure to ${utils.formatStatus(branchAction)} branch?`))
            .then((result) => {
                if (result.value) {
                    const url = `${ApiUrl.branch}/status/${branchId}/${branchAction}`;
                    axios.put(url, {})
                    .then((response) => {
                        if (response.status === 200) {
                            window.livewire.emit('onUpdateBranch', branchId);
                            window.livewire.emit('onChangeBranch', branchId);
                            Swal.fire('Branch Updated!!!', '', 'success');
                        }
                    })
                    .catch((error) => console.log(error));
                }
            })

        });

    }

}


