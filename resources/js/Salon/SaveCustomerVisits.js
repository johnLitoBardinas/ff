import Swal from 'sweetalert2';

const utils = require('../utils');

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

            if (! dates.length) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!!!',
                    text: 'Fill out the Visitation Date'
                });
                return;
            }

            delete data['date'];

            dates.forEach((element, index) => {
                const customerVisitsData = {
                    ... data,
                    date: element
                };
                console.log(index, customerVisitsData);
                axios.post(`${ApiUrl.customers}/${data['customer_id']}/visits`, customerVisitsData)
                .then((response) => {
                    if (response.status === 201) {
                        Swal.fire('Saved Customer Visits', '', 'success');
                    }
                    window.livewire.emit('onUpdateCustomerVisits', data['customer_package_id']);
                    $(e.currentTarget).attr('disabled', true);
                })
                .catch((error) => console.error(error));
            });
        });
    }
}