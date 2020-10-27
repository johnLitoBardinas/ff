export default class SalonTable {

    constructor() {
        this.$salonTable = $("#salon-table");
        this.onTogglePackageInfo();
    }

    onTogglePackageInfo() {
        this.$salonTable.on('click', '[data-action="togglePackageInfo"]', (e) => {
            $(e.currentTarget).toggleClass('btn-icon__close-row');
            $(e.currentTarget).closest('td').prev().find('tbody').toggleClass('d-none');
        });
    }

}