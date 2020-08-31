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

        this.saveBranchForm();

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
                .finally(() => {
                    $(e.currentTarget).attr('disabled', false);
                });
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
                console.log('Modal Branch Form is Valid');
                console.log('data', data);
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

}