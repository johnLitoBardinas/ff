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
        this.onToggleVisitForm();
        this.onSubmitVisitForm();
        // console.log('date format', );

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

    // Viewing Package service information
    onClickPackageInformationVisits() {
        console.log('watcher now attached');

        this.$managementTable.on('click', '[data-action="serviceModalStatus"]', (e) => {
            e.preventDefault();

            console.log('serviceModalStatus', e.currentTarget.dataset);
            let { customerPackageId, userBranchId, userId, serviceType, customerUserId, currentUserBranchtype, serviceStatus, serviceExpirationDate, serviceTotalVisits, serviceCurrentVisitsLogs, serviceCurrentVisitcount } = e.currentTarget.dataset;

            let rows = '';

            let visitLogs = JSON.parse(serviceCurrentVisitsLogs);

            // completed package service
            if (serviceTotalVisits === serviceCurrentVisitcount && serviceStatus !== 'expired') {

                for (let i = 0; i < serviceCurrentVisitcount; i++) {
                    rows += `
                        <tr>
                            <td class="text-center">${moment(visitLogs[i].date).format('ll')}</td>
                            <td>Consumed</td>
                        </tr>
                    `;
                }

            } else {

                // expired package service
                if (serviceStatus === 'expired') {

                    rows += `
                        <tr>
                            <td class="text-center">${moment(serviceExpirationDate).format('ll')}</td>
                            <td>Expired</td>
                        </tr>
                    `;

                } else {

                    // active || active + comsumed package service
                    for (let index = 0; index < serviceTotalVisits; index++) {

                        if (index < serviceCurrentVisitcount) {
                            // console.log(`${index} i => `, );
                            rows += `
                            <tr>
                                <td>${moment(visitLogs[index].date).format('ll')}</td>
                                <td>Consumed</td>
                            </tr>
                            `;
                        }
                    }

                    if (serviceCurrentVisitcount < serviceTotalVisits) {
                        let currentDate = utils.getDateWithFormat('YYYY-MM-DD');
                        rows += `
                                <tr>
                                    <td>Consumable</td>
                                    <td class="mgmt-modal-visitation">
                                        <button class="btn btn-sm btn-primary" data-action="addVisit">ADD VISIT</button>
                                        <form class="form-inline frm-add-visit" method="POST">
                                            <input type="date" class="form-control" required min="${currentDate}" value="${currentDate}"/> &nbsp;
                                            <button type="submit" class="btn btn-sm btn-primary" data-action="submitVisit" data-customer-package-id="${customerPackageId}" data-user-branch-id="${userBranchId}" data-user-id="${userId}" data-service-type="${serviceType}" data-customer-id="${customerUserId}">SAVE</button> &nbsp;
                                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" data-action="addVisitBack">BACK</a>
                                        </form>
                                    </td>
                                </tr>
                                `;
                    }


                }

            }

            this.$managementModal.find('.mgmt-service-modal-title').text(`${serviceType.toUpperCase()} - Visitation Status`);
            this.$managementModal.find('.mgmt-service-modal__tbody').empty().append(rows);
            this.$managementModal.find('.consumed-visits').text(serviceCurrentVisitcount.toString());
            this.$managementModal.find('.total-visits').text(serviceTotalVisits.toString());
            this.$managementModal.modal('show');

        });
    }

    // Toggling the visitation form.
    onToggleVisitForm() {
        this.$managementModal.find('.mgmt-service-modal__tbody').on('click', '[data-action="addVisit"]', function (e) {
            e.preventDefault();
            $(e.currentTarget).hide();
            $(e.currentTarget).siblings('form').css('display', 'block');
        });

        this.$managementModal.find('.mgmt-service-modal__tbody').on('click', '[data-action="addVisitBack"]', function (e) {
            e.preventDefault();
            $(e.currentTarget).closest('.mgmt-modal-visitation').find('[data-action="addVisit"]').show();
            $(e.currentTarget).closest('form').css('display', 'none');
        });
    }

    // oSubmit of visitation
    onSubmitVisitForm() {
        console.log('attached on submit visit form');
        this.$managementModal.find('.mgmt-service-modal__tbody').on('click', '[data-action="submitVisit"]', function name(e) {
            e.preventDefault();

            let self = $(e.currentTarget);
            self.attr('disabled', true);

            let selectedDate = $(e.currentTarget).siblings('input[type="date"]').val();
            let { customerId, customerPackageId, serviceType, userBranchId, userId } = e.currentTarget.dataset;
            axios.post(`${ApiUrl.customers}/${customerId}/visits`, {
                'customer_package_id': customerPackageId,
                'branch_id': userBranchId,
                'user_id': userId,
                'date': selectedDate,
                'package_type': serviceType
            }).then((response) => {

                let refNo = response.data.data.refno;

                if (refNo) {
                    if (response.status === 201) {
                        Swal.fire('Saved Customer Visits', '', 'success');
                        setTimeout(function() {
                            window.location.href = `/home/?refno=${refNo}`;
                        }, 1000)
                    }
                } else {
                    console.log('no ref no');
                }


            })
            .catch(error => {
                self.attr('disabled', false);
                console.log(error)
            });

        });

    }

}
