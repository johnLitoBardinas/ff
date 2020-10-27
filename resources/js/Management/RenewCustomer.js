const utils = require('../utils');

import Swal from 'sweetalert2';

export default class RenewCustomer {

    constructor() {
        this.$frmRenewCustomer = $("#frm-renew-customer");
        this.$btnSaveRenewCustomer = $("#btn-save-renew-customer");

        this.onSubmitRenewCustomer();
    }

    onSubmitRenewCustomer() {
        this.$btnSaveRenewCustomer.on('click', (e) => {
            $(e.currentTarget).attr('disabled', true);
            const parsleyForm = this.$frmRenewCustomer.parsley();
            const data = this.$frmRenewCustomer.serializeObject();

            parsleyForm.validate();



            if (parsleyForm.isValid()) {
                const customerPackageUrl = `${ApiUrl.customers}/${data['customer_id']}/packages`;
                const customerVisitsUrl = `${ApiUrl.customers}/${data['customer_id']}/visits`;
                const packageType = data['package_type'];

                axios.post(customerPackageUrl, data)
                .then((response) => response.data)
                .then((customerPackageData) => {
                    customerPackageData['package_type'] = packageType;
                    axios.post(customerVisitsUrl, customerPackageData)
                    .then((response) => {
                        if (response.status === 201) {
                            Swal.fire('Customer Successfully Renew', '', 'success');
                            this.$frmRenewCustomer[0].reset();
                            parsleyForm.reset();
                        }
                        $(e.currentTarget).attr('disabled', false);
                    }).catch((error) => utils.axiosErrorCallback(error));
                })
                .catch((error) => utils.axiosErrorCallback(error))
            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }


}