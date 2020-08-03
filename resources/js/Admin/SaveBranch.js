const utils = require('../utils');

import Swal from 'sweetalert2';

export default class SaveBranch {

    constructor () {
        this.$btnShowAddBranch = $("#showAddBranch");

        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");

        this.onShowAddBranchForm();
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
                        window.livewire.emit('onUpdateBranch', response.data['branch_id']);
                        Swal.fire('Branch Updated!!!', '', 'success');
                    }
                })
                .catch((error) => console.log(error));
            }

        });
    }

    onShowAddBranchForm() {
        this.$btnShowAddBranch.on('click', (e) => {
            Swal.fire({
                title: 'Branch Form',
                html: `
                    <em> You can add user after the branch is save.. </em>
                    <input type="text" id="branch-name" class="swal2-input" placeholder="Branch Name" />
                    <input type="text" id="branch-address" class="swal2-input" placeholder="Branch Address" />
                `,
                icon: 'question',
                confirmButtonText: 'Save',
                preConfirm: () => {
                    let branchName = Swal.getPopup().querySelector('#branch-name').value
                    let branchAddress = Swal.getPopup().querySelector('#branch-address').value
                    if (branchName === '' || branchAddress === '') {
                        Swal.showValidationMessage(`Empty &nbsp <b>Branch Name</b> &nbsp or &nbsp <b>Branch Address</b>`)
                    }
                    return {branchName, branchAddress}
                }
            }).then((result) => {
                const data = {
                    'branch_name': result.value.branchName,
                    'branch_address': result.value.branchAddress,
                };

                axios.post(ApiUrl.branch, data)
                .then((response) => {
                    if (response.status === 200) {
                        window.livewire.emit('onUpdateBranch', response.data['branch_id']);
                        window.livewire.emit('onChangeBranch', response.data['branch_id']);
                        Swal.fire('Branch Added!!!', '', 'success');
                    }
                });
            })
            .catch((error) => console.log(error));

        });
    }

}