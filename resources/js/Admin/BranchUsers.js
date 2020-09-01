const utils = require('../utils');

import 'parsleyjs';
import Swal from 'sweetalert2';

export default class BranchUsers {

    constructor() {
        this.$btnAddUser = $("#btn-branch-user");
        this.$modalBranchUser = $("#modal-user-form");
        this.$frmBranchUser = $("#frm-branch-users");
        this.$btnSaveBranchUser = $("#btn-save-branch-user");

        this.onClickAddUser();
        this.onSubmitForm();
        this.onModalClose();
    }

    onClickAddUser() {
        this.$btnAddUser.on('click', (e) => {
            const { branchid, branchname } = e.currentTarget.dataset;
            this.$modalBranchUser.find('#modal-user-form__branch-name').text(branchname);
            this.$modalBranchUser.find('#modal-user-form__branch-id').val(branchid);
            this.$modalBranchUser.modal({backdrop: 'static', keyboard: false});
        });
    }

    onSubmitForm() {
        this.$btnSaveBranchUser.on('click', (e) => {
            const parsleyForm = this.$frmBranchUser.parsley();
            const branchName = $(e.currentTarget).closest("#modal-user-form__branch-name").text();
            parsleyForm.validate();

            if ( parsleyForm.isValid() ) {
                const data = this.$frmBranchUser.serializeObject();

                axios.post(ApiUrl.users, data)
                .then((response) => {
                    this.$modalBranchUser.modal('hide');

                    if (response.status === 200) {
                        const data = response.data;
                        window.livewire.emit('onUpdateBranch', data['branch_id']);
                        window.livewire.emit('onChangeBranch', data['branch_id']);
                        Swal.fire('User Added', `${data['first_name']} is now in Branch ${branchName}`, 'success');
                    }
                })
                .catch((error) => console.error(error));
            }
        });
    }

    onModalClose() {
        this.$modalBranchUser.on('hidden.bs.modal', (e) => {
            this.$frmBranchUser[0].reset();
            this.$frmBranchUser.parsley().reset();
        });
    }
}