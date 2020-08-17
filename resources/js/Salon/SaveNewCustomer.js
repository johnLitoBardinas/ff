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
        return ;
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

        // let customer = await ;
        // // const customerPackage = await this.postNewCustomerPackage(data, customer_id);

        // console.log('customer', customer);
        // return customer;

        /**
         * Check all the following storing Request Multiple AJAX Request for this One.
         *
         * 1. New Customer.
         * 2. Tag the Customer to its Package.
         * 3. Tag the first Customer Package Visits.
         */

    }

    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (e) => {
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeObject();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                // this.subcribeCustomerPackage(data);

                axios.post(ApiUrl.customers, data)
                .then((result) => result.data)
                .then((customerData) => {
                    const customerPackageUrl = `${ApiUrl.customers}/${customerData['customer_id']}/packages`;
                    const customerPackageData = {
                        ...customerData,
                        ...data
                    };
                    delete customerPackageData['created_at'];
                    delete customerPackageData['updated_at'];

                    axios.post(customerPackageUrl, customerPackageData)
                    .then((customerPackage) => {
                       console.log('customerPackage', customerPackage);
                    });
                }).catch((error) => console.error(error));
            }

        });
    }

}