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
            const formAction = $('input[name="action"]').val() || 'readBranch';
            const data = utils.formatBranchData(this.$adminBranchForm.find("#frm-branch").serializeObject());
            const url = formAction === 'editBranch' ? `${ApiUrl.branch}/${data['current_branch_id']}` : ApiUrl.branch;

            if ( formAction === 'editBranch' ) {
                axios.put(url, data)
                .then((response) => {
                    if (response.status === 200) {
                        window.livewire.emit('onUpdateBranch', response.data['branch_id']);
                        window.livewire.emit('onChangeBranch', response.data['branch_id']);
                        Swal.fire('Branch Updated!!!', '', 'success');
                    }
                })
                .catch((error) => console.log(error));
            } else {
                console.log('ReadBranch');
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
                    let branchName = Swal.getPopup().querySelector('#branch-name').value || '';
                    let branchAddress = Swal.getPopup().querySelector('#branch-address').value || '';
                    if (branchName === '' || branchAddress === '') {
                        Swal.showValidationMessage(`Empty &nbsp <b>Branch Name</b> &nbsp or &nbsp <b>Branch Address</b>`)
                    }
                    return {branchName, branchAddress}
                }
            }).then((result) => {

                if ( result.value === undefined) {
                    return;
                }

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
                }).catch((error) => {
                    const errorData = error.response.data;
                    const errorMessage = errorData.message || 'Error';
                    Swal.fire({
                        icon: 'error',
                        title: errorMessage,
                        html: `<b>Branch Name</b> or <b>Branch Address</b> already existed.`
                    });
                });


            })
            .catch((error) => console.log('Is this called??'));

        });
    }

}