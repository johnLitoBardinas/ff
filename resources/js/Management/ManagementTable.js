import Swal from 'sweetalert2';

import utils from '../utils';

export default class ManagementTable {

    constructor() {
        this.$managementTable = $("#management-table");
        this.onTogglePackageInfo();
        this.onToggleGymVisitation();
    }

    onTogglePackageInfo() {
        this.$managementTable.on('click', '[data-action="togglePackageInfo"]', (e) => {
            $(e.currentTarget).toggleClass('btn-icon__close-row');
            $(e.currentTarget).closest('td').prev().find('tbody').toggleClass('d-none');
        });
    }

    onToggleGymVisitation() {
        this.$managementTable.on('click', '[data-action="customerGymVisitation"]', (e) => {
           const { customer, cpackageid, branch, userid, visitation } = e.currentTarget.dataset;
           $(e.currentTarget).closest('.gym-visitation').find('a.active').removeClass('active');
           $(e.currentTarget).addClass('active');

           const data = {
            'customer_package_id': cpackageid,
            'branch_id': branch,
            'user_id': userid,
            'visitation_type': visitation
           };

           axios.post(`${ApiUrl.customers}/${customer}/gymvisitation`, data)
           .then((response) => {
               if (response.status === 201) {
                   Swal.fire(utils.swal2Option('success', 'Customer Gym Package Updated',`Customer now ${visitation}.`));
               }
           })
           .catch((errors) => Swal.fire(utils.swal2Option('error', 'Error Gym Package', errors.response.data.error)));
        });
    }

}