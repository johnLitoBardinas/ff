export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (e) => {
            const data = this.$frmNewCustomer.serializeArray();
            console.log('data', data);
        });
    }

}