export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    /**
     * Posting new Customer.
     *
     * @param {Object} customerData
     */
    postNewCustomer(customerData) {
        return axios.post(ApiUrl.customers, customerData);
    }

    /**
     * Subscribing new Customer to a particular package.
     *
     * @param {Object} customerPackageData
     * @param {Int} customerId
     */
    postNewCustomerPackage(customerPackageData, customerId) {
        const url = `${ApiUrl.customers}/${customerId}/packages`;
        return axios.post(url, customerPackageData);
    }

    /**
     * Logging the visits for Customer.
     * @param {Object} visitsInfo
     */
    postNewCustomerVisits(visitsInfo, customerId) {
        const url = `${ApiUrl.customers}/${customerId}/visits`;
    }

    async subcribeCustomerPackage(data) {

        const customerId = await this.postNewCustomer(data);
        const customerPackage = await this.postNewCustomerPackage(data, customerId);


    }

    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (e) => {
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeObject();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                this.subcribeCustomerPackage(data);
            }

        });
    }

}