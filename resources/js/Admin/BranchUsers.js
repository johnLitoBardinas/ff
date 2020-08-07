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
    }

    onClickAddUser() {
        this.$btnAddUser.on('click', (e) => {
            this.$frmBranchUser[0].reset();
            this.$modalBranchUser.modal({backdrop: 'static', keyboard: false});
        });
    }

    onSubmitForm() {
        this.$btnSaveBranchUser.on('click', (e) => {
            const parsleyForm = this.$frmBranchUser.parsley();
            const branchName = $(e.currentTarget).closest("#modal-title").text();
            parsleyForm.validate();

            if ( parsleyForm.isValid() ) {
                const data = this.$frmBranchUser.serializeObject();

                axios.post(ApiUrl.users, data)
                .then((response) => {
                    console.log(response);
                    console.log('isTrue?:', response.status === 200);
                    if (response.status === 200) {
                        const data = response.data;
                        util.updateBranch(data['branch_id']);
                        Swal.fire('User Added', `${data['first_name']} is now in Branch ${branchName}`, 'success');
                    }
                })
                .catch((error) => {
                    // Tomorrow will be the error on server here.
                });
            }


        });
    }
}