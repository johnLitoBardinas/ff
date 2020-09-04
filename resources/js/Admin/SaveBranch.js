const utils = require('../utils');

import Swal from 'sweetalert2';

export default class SaveBranch {

    constructor () {
        this.$btnShowAddBranch = $("#showAddBranch");
        this.$modalBranchForm = $("#modal-branch-form");
        this.$frmBranchFormNew = $("#frm-branch-new");
        this.$btnSaveNewBranch = $("#btn-save-new-branch");

        // Editing the Branch.
        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");
        this.$btnDestroyBranch = $("#btn-destroy-branch");

        this.saveBranchForm();

        this.onDestroyBranch();

        this.onShowAddBranchForm();
        this.onSaveModalBranchForm();
        this.onCloseBranchModal();
    }

    /**
     * Saving the Branch Form. for editing the branch data and Branch User.
     */
    saveBranchForm() {
        this.$btnSaveBranch.on('click', (e) => {
            $(e.currentTarget).attr('disabled', true);
            const frmBranchInfo = this.$adminBranchForm.find("#frm-branch").parsley();
            const data = utils.formatBranchData(this.$adminBranchForm.find("#frm-branch").serializeObject());
            const url = `${ApiUrl.branch}/${data['current_branch_id']}`;

            frmBranchInfo.validate();

            if (frmBranchInfo.isValid()) {
                axios.put(url, data)
                .then((response) => {
                    if (response.status === 200) {
                        window.livewire.emit('onUpdateBranch', response.data['branch_id']);
                        window.livewire.emit('onChangeBranch', response.data['branch_id']);
                        Swal.fire('Branch Updated!!!', '', 'success');
                    }
                })
                .catch((error) => console.log(error))
                .finally(() => $(e.currentTarget).attr('disabled', false));
            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

    /**
     * Showing the Add Branch Modal.
     */
    onShowAddBranchForm() {
        this.$btnShowAddBranch.on('click', (e) => {
            this.$modalBranchForm.modal({backdrop: 'static', keyboard: false});
        });
    }

    /**
     * Saving the Add Branch Modal form.
     */
    onSaveModalBranchForm() {
        this.$btnSaveNewBranch.on('click', (e) => {
            $(e.currentTarget).attr('disabled', true);
            const parsleyForm = this.$frmBranchFormNew.parsley();
            const data = this.$frmBranchFormNew.serializeObject();
            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                axios.post(ApiUrl.branch, data)
                .then((response) => {
                    this.$modalBranchForm.modal('hide');
                    if (response.status === 201) {
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
                })
                .finally(() => $(e.currentTarget).attr('disabled', false));

            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

    /**
     * On Close Branch Modal.
     */
    onCloseBranchModal() {
        this.$modalBranchForm.on('hidden.bs.modal', (e) => {
            this.$frmBranchFormNew[0].reset();
            this.$frmBranchFormNew.parsley().reset();
        });
    }

    /**
     * On Destroy Branch.
     */
    onDestroyBranch() {
        this.$btnDestroyBranch.on('click', (e) => {
            const { branchid } = e.currentTarget.dataset;

            console.log('Branch Id', branchid);
            // Swal.fire(utils.swal2Option('warning', 'Warning', `Are you sure to Permanently Delete the Branch? Branch Users will be deleted as well.`))
            // .then((result) => {
            //     if (result.value) {
            //         axios.delete(`${ApiUrl.branch}/${branchid}`)
            //         .then((response) => {
            //             window.livewire.emit('onUpdateBranch');
            //             Swal.fire('Branch Updated!!!', '', 'success');
            //         })
            //         .catch((error) => console.error(error));
            //     }
            // });


        });
    }

}