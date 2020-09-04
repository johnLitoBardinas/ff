const utils = require('../utils');

export default class Package {

    constructor() {
        this.$frmPackage = $("#frm-new-package");
        this.$btnSavePackage = $("#btn-save-package");

        this.onSavePackage();
    }

    onSavePackage() {
        this.$btnSavePackage.on('click', (e) => {
            $(e.currentTarget).attr('disabled', true);

            const parsleyForm = this.$frmPackage.parsley();
            const data = this.$frmPackage.serializeObject();

            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                console.log('current Element', e.currentTarget);
                console.log('current Data', data);
            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

}


