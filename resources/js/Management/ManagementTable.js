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
           const { cpackageid, branch, userid, visitation } = e.currentTarget.dataset;
           $(e.currentTarget).closest('.gym-visitation').find('a.active').removeClass('active');
           $(e.currentTarget).addClass('active');
           console.log('customer_package_id', cpackageid);
           console.log('branch_id', branch);
           console.log('user_id', userid);
           console.log('visitation_status', visitation);
        });
    }

}