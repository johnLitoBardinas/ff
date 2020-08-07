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
            parsleyForm.validate();

            if ( parsleyForm.isValid() ) {
                const data = this.$frmBranchUser.serializeObject();
                console.log('data', data);
            }


        });
    }
}