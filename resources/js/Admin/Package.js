const utils = require('../utils');

import Swal from "sweetalert2";

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
                axios.post(ApiUrl.packages, data)
                .then((packageResponse) => {
                    if (packageResponse.status === 201) {
                        Swal.fire(`Package added!!!`, '', 'success');
                    }
                    parsleyForm.reset();
                    $(e.currentTarget).attr('disabled', false);
                    this.$frmPackage[0].reset();
                })
                .catch(error => utils.axiosErrorCallback(error))
                .finally(() => console.log('finally'));

            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

}


