import Swal from 'sweetalert2';

import moment from 'moment';

import utils from '../utils';

export default class ManagementTable {

    constructor() {
        this.$managementTable = $("#management-table");
        this.$managementModal = $("#mgmt-service-modal");
        this.onTogglePackageInfo();
        this.onToggleGymVisitation();
        this.onClickPackageInformationVisits();
        this.onClickMgmtModalAddVisit();
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

    onClickPackageInformationVisits() {

        const computeRow = (userCurrentBranch, serviceType, totalVisits, status, currentVisits) => {

            let rows = '';

            if(status === 'active') {
                // salon === salon
                if (userCurrentBranch === serviceType) {
                    for (let index = 1; index < (totalVisits + 1); index++) {
                        rows += `
                        <tr>
                            <td>Available to Visit</td>
                            <td class="text-center mgmt-modal-visitation">
                                <button class="btn btn-sm btn-primary" data-action="addVisit">ADD VISIT</button>
                                <form class="form-inline frm-add-visit">
                                    <input type="date" class="form-control" /> &nbsp; <button type="submit" class="btn btn-sm btn-primary" data-action="saveVisit">SAVE</button> &nbsp;
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-action="addVisitBack">BACK</a>
                                </form>
                            </td>
                        </tr>
                        `;
                    }
                } else {

                    // Hoisted Variable error.
                    for (let index = 1; index < (totalVisits + 1); index++) {
                        rows += `
                        <tr>
                            <td class="text-center">-</td>
                            <td>Consumable</td>
                        </tr>
                        `;
                    }
                }
            }

            return rows;
        };

        this.$managementTable.on('click', '[data-action="serviceModalStatus"]', (e) => {

            //  console.log('service Dataset', e.currentTarget.dataset);
            let { currentUserBranchtype, serviceType, serviceStatus, serviceVisits, serviceCurrentvisits } = e.currentTarget.dataset;

            console.log({ currentUserBranchtype, serviceType, serviceStatus, serviceVisits, serviceCurrentvisits });

            this.$managementModal.find('.mgmt-service-modal-title').text(`${serviceType.toUpperCase()} - Visitation Status`);

            this.$managementModal.find(".mgmt-service-modal__tbody").empty().append(`${computeRow(currentUserBranchtype, serviceType, serviceVisits, serviceStatus, JSON.parse(serviceCurrentvisits))}`);

            this.$managementModal.find('.total-visits').text(serviceVisits.toString());
            this.$managementModal.modal('show');

            // console.log({
            //     userCurrentBranch,
            //     serviceType,
            //     status,
            //     totalVisits,
            //     currentVisits
            // });
            // console.log('onClick data-action="ServiceModal"');

        });

    }

    onClickMgmtModalAddVisit() {
        this.$managementModal.find('.mgmt-modal-visitation').on('click', 'button[data-action="addVisit"]', function (e) {
            $(e.currentTarget).fadeOut(0, function () {
                $(e.currentTarget).siblings('form.frm-add-visit').css({'display':'flex', 'align-items':'baseline' });
            });
        });

        this.$managementModal.find('.mgmt-modal-visitation').on('click', 'a[data-action="addVisitBack"]', function (e) {
            $(e.currentTarget).closest('.frm-add-visit').css('display', 'none');
            $(e.currentTarget).closest('td').find('button[data-action="addVisit"]').show();
        });
    }

    onSaveMgmtModalVisit() {
    //    this.$managementModal.find()
    }

}
/**
        <tr>
            <td>Feb. 27, 2021</td>
            <td>Consumed</td>
        </tr>
        <tr>
            <td>Consumable</td>
            <td class="mgmt-modal-visitation">
                <button class="btn btn-sm btn-primary" data-action="addVisit">ADD VISIT</button>
                <form class="form-inline frm-add-visit">
                    <input type="date" class="form-control" /> &nbsp; <button type="submit" class="btn btn-sm btn-primary" data-action="saveVisit">SAVE</button> &nbsp;
                    <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-action="addVisitBack">BACK</a>
                </form>
            </td>
        </tr>
        <tr>
            <td class="text-center">-</td>
            <td>Consumable</td>
        </tr>
        <tr>
            <td class="text-center">-</td>
            <td>Expired</td>
        </tr>




 */