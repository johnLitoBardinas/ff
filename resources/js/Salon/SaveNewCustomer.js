import Swal from 'sweetalert2';

export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    submitNewCustomer(data, parsley, event, packageType) {

        axios.post(ApiUrl.customers, data)
        .then((result) => result.data)
        .then((customerData) => {
            const customerPackageUrl = `${ApiUrl.customers}/${customerData['customer_id']}/packages`;
            const customerPackageData = {
                ...customerData,
                ...data
            };

            axios.post(customerPackageUrl, customerPackageData)
            .then((customerPackage) => {
                delete customerPackage.data['payment_type'];
                delete customerPackage.data['reference_no'];
                customerPackage['data']['package_type'] = packageType;

                const customerVisitsUrl = `${ApiUrl.customers}/${customerPackage.data['customer_id']}/visits`;
                axios.post(customerVisitsUrl, customerPackage.data)
                .then((customerVisits) => {
                    if (customerVisits.status === 201) {
                        Swal.fire('Customer Successfully Subscribed', '', 'success');
                        this.$frmNewCustomer[0].reset();
                        parsley.reset();
                        $(event.currentTarget).attr('disabled', false);
                    }
                });

            });
        });
    }

    /**
     * Submiting new Customer Data.
     */
    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (event) => {
            $(event.currentTarget).attr('disabled', true);
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeObject();
            const packageType = data['package_type'];

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                this.submitNewCustomer(data, parsleyForm, event, packageType);
            }else {
                $(event.currentTarget).attr('disabled', false);
            }

        });
    }

}