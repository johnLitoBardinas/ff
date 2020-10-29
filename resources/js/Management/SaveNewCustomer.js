import Swal from 'sweetalert2';

const utils = require('../utils');

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

                axios.post(ApiUrl.customers, this.formatCustomerData(data))
                .then((response) => {
                    return {
                        ...response.data,
                        ...data
                    };
                })
                .then((customerWithPackageInfo) =>axios.post(`${ApiUrl.customers}/${customerWithPackageInfo['customer_id']}/packages`, this.formatCustomerPackageData(customerWithPackageInfo)))
                .then((response) => {
                    const customerVisitsInfo = {
                        ...response.data,
                        ...data
                    };

                    axios.post(`${ApiUrl.customers}/${response.data['customer_id']}/visits`, this.formatCustomerPackageVisitation(customerVisitsInfo))
                    .then((response) => {
                        if (response.status === 201) {
                            Swal.fire('Customer Successfully Subscribed', '', 'success');
                            this.$frmNewCustomer[0].reset();
                            parsleyForm.reset();
                            $(event.currentTarget).attr('disabled', false);
                        }
                    });
                })
                .catch((error) => utils.axiosErrorCallback(error));

            } else {
                $(event.currentTarget).attr('disabled', false);
            }

        });
    }

}
