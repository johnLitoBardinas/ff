const utils = require('../utils');

import Swal from 'sweetalert2';

export default class SaveBranch {

    constructor () {
        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");

        this.saveBranchForm();
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            const data = utils.formatBranchData(this.$adminBranchForm.find("#frm-branch").serializeObject());
            const url = data.action === 'editBranch' ? `${ApiUrl.branch}/${data['current_branch_id']}` : ApiUrl.branch;

            if ( data.action === 'editBranch' ) {
                axios.put(url, data)
                .then((response) => {
                    if (response.status === 200) {
                        window.livewire.emit('onUpdateBranch');
                        Swal.fire('Branch Updated!!!', '', 'success');
                    }
                })
                .catch((error) => console.log(error));
            }

        });
    }

}