export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (e) => {
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeArray();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                console.log('data', data);
            }

        });
    }

}