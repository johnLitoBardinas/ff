import { formatBranchData } from '../utils';
import Swal from 'sweetalert2';

export default class SaveBranch {

    constructor () {
        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");

        this.branchApi = '/api/branch';

        this.saveBranchForm();
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            const data = formatBranchData(this.$adminBranchForm.find("#frm-branch").serializeObject());
            const url = data.action === 'editBranch' ? `${this.branchApi}/${data['current_branch_id']}` : this.branchApi;

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