import 'parsleyjs';
import Swal from 'sweetalert2';

import utils from '../utils';

export default class BranchUsers {

    constructor() {
        this.$divAdminBranchForm = $("#admin-branches-form");
        this.$modalBranchUser = $("#modal-user-form");
        this.$frmBranchUser = $("#frm-branch-users");
        this.$btnSaveBranchUser = $("#btn-save-branch-user");

        this.onClickAddUser();
        this.onSubmitBranchUserForm();
        this.onModalClose();
    }

    onClickAddUser() {

        this.$divAdminBranchForm.on("click", "#btn-branch-user", (e) => {
            const { branchid, branchname } = e.currentTarget.dataset;
            this.$divAdminBranchForm.find("#modal-user-form").find('#modal-user-form__branch-name').text(branchname);
            this.$divAdminBranchForm.find("#modal-user-form").find('#modal-user-form__branch-id').val(branchid);
            $("#modal-user-form").modal({backdrop: 'static', keyboard: false});
        });

    }

    onSubmitBranchUserForm() {

        this.$modalBranchUser.find("#btn-save-branch-user").on("click", (e) => {

            const parsleyForm = this.$frmBranchUser.parsley();
            const branchName = $(e.currentTarget).closest("#modal-user-form__branch-name").text();
            parsleyForm.validate();

            if ( parsleyForm.isValid() ) {
                const data = this.$frmBranchUser.serializeObject();
                $(e.currentTarget).attr('disabled', true);

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
                .catch((error) => utils.axiosErrorCallback(error))
                .finally(() => $(e.currentTarget).attr('disabled', false));
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