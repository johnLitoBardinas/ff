import Swal from 'sweetalert2';

import utils from '../utils';

export default class SaveNewCustomer {

    constructor() {
        this.$frmNewCustomer = $("#frm-new-account");
        this.$btnSaveNewCustomer = $("#btn-save-new-customer");

        this.onSubmitFormNewCustomer();
    }

    // Format data for Customer Data.
    formatCustomerData(data) {
        return {
            'first_name': data['first_name'],
            'last_name': data['last_name'],
        };
    }

    // Format data for Customer Package Data.
    formatCustomerPackageData(data) {
        return {
            'user_id': data['user_id'],
            'branch_id': data['branch_id'],
            'customer_id': data['customer_id'],
            'reference_no': data['reference_no'],
            'package_type': data['package_type'],
            'package_id': data['package_id'],
            'payment_type': data['payment_type'],
        };
    }

    // Format data for Customer Package Visitation.
    formatCustomerPackageVisitation(data) {
        return {
            'customer_package_id': data['customer_package_id'],
            'branch_id': data['branch_id'],
            'user_id': data['user_id'],
            'package_type': data['package_type']
        };
    }

    // Submission of new Customer
    onSubmitFormNewCustomer() {
        this.$btnSaveNewCustomer.on('click', (event) => {
            $(event.currentTarget).attr('disabled', true);
            const parsleyForm = this.$frmNewCustomer.parsley();
            const data = this.$frmNewCustomer.serializeObject();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {

                // Register the customer.
                axios.post(ApiUrl.customers, this.formatCustomerData(data))
                .then((response) => {
                    return {
                        ...response.data,
                        ...data
                    };
                })
                // Register the created customer to the subscribe package.
                .then((customerWithPackageInfo) => axios.post(`${ApiUrl.customers}/${customerWithPackageInfo['customer_id']}/packages`, this.formatCustomerPackageData(customerWithPackageInfo)))
                .then((response) => {

                    const refNo = response.data.reference_no;

                    if (response.status === 200) {
                        Swal.fire('Customer Successfully Subscribed', '', 'success');
                        this.$frmNewCustomer[0].reset();
                        parsleyForm.reset();
                        $(event.currentTarget).attr('disabled', false);

                        window.location.href = `/home/?refno=${refNo}`;
                    }
                })
                .catch((error) => {
                    utils.axiosErrorCallback(error);
                    $(event.currentTarget).attr('disabled', false);
                });

            } else {
                $(event.currentTarget).attr('disabled', false);
            }

        });
    }

}
