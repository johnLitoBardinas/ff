import Swal from 'sweetalert2';

import utils from '../utils';

export default class SaveCustomerVisits {

    constructor() {
        this.$frmCustomerVisits = $("#frm-customer-visits");
        this.$btnSaveCustomerVisits = $("#btn-save-customer-visits");

        this.onCustomerVisitsUpdate();
    }

    onCustomerVisitsUpdate() {
        this.$btnSaveCustomerVisits.on('click', (e) => {

            $(e.currentTarget).attr('disabled', true);
            const data = this.$frmCustomerVisits.serializeObject();
            const dates = utils.removeEmptyValueFromIterable(data['date']);

            delete data['date'];

            dates.forEach((element, index) => {

                const customerVisitsData = {
                    ... data,
                    date: element,
                    'package_type': data['package_type']
                };

                axios.post(`${ApiUrl.customers}/${data['customer_id']}/visits`, customerVisitsData)
                .then((response) => {
                    if (response.status === 201) {
                        Swal.fire('Saved Customer Visits', '', 'success');
                    }
                    window.livewire.emit('onUpdateCustomerVisits', data['customer_package_id']);
                    $(e.currentTarget).attr('disabled', true);
                })
                .catch(error => utils.axiosErrorCallback(error));

            });
        });
    }
}