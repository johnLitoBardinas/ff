import Swal from 'sweetalert2';

export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    /**
     * Submiting new Customer Data.
     */
    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (e) => {
            $(e.currentTarget).attr('disabled', true);
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeObject();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                // Need to Refactor But for now this is GOOD but not GREAT
                axios.post(ApiUrl.customers, data)
                .then((result) => result.data)
                .then((customerData) => {
                    // console.log('1 customerData', customerData);
                    const customerPackageUrl = `${ApiUrl.customers}/${customerData['customer_id']}/packages`;
                    const customerPackageData = {
                        ...customerData,
                        ...data
                    };

                    axios.post(customerPackageUrl, customerPackageData)
                    .then((customerPackage) => {
                    //    console.log('2 customerPackage', customerPackage.data);

                       delete customerPackage.data['payment_type'];
                       delete customerPackage.data['reference_no'];

                       const customerVisitsUrl = `${ApiUrl.customers}/${customerPackage.data['customer_id']}/visits`;
                       axios.post(customerVisitsUrl, customerPackage.data)
                       .then((customerVisits) => {
                            if (customerVisits.status === 201) {
                                Swal.fire('Customer Successfully Subscribed', '', 'success');
                                this.$frmNewCustomer[0].reset();
                                parsleyForm.reset();
                            }
                            $(e.currentTarget).attr('disabled', false);
                       });

                    });
                }).catch((error) => console.error(error));

            }else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

}