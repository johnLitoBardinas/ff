import Swal from "sweetalert2";

import utils from '../utils';

export default class Package {

    constructor() {
        this.$frmPackage = $("#frm-new-package");
        this.$btnSavePackage = $("#btn-save-package");

        this.$tblPackage = $("#tbl-package");

        this.onSavePackage();
        this.onDeletePackage();
    }

    // Saving the Package.
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
                .catch(error => {
                    utils.axiosErrorCallback(error)
                    $(e.currentTarget).attr('disabled', false);
                })
                .finally(() => console.log('saved package'));

            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

    // On Deletion of Package.
    onDeletePackage() {
        this.$tblPackage.on('click', '[data-action="delete"]', (e) => {
            const { packageid } = e.currentTarget.dataset;

            Swal.fire(utils.swal2Option('warning', 'Are you sure?', 'Deleted Package will never come back!!'))
            .then((result) => {
                if (result.value) {
                    axios.delete(`${ApiUrl.packages}/${packageid}`)
                    .then(deletedPackage => {
                        if (deletedPackage.status === 200) {
                            window.livewire.emit('onDeletePackage');
                            Swal.fire(utils.swal2Option('success', 'Success!!', 'Package Deleted.'));
                        }
                    })
                    .catch((error) => utils.axiosErrorCallback(error));
                }
            })
        });
    }

}


