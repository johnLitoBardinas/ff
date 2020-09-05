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
                .catch((error) => {
                    let errorMsg = error.response.data.message;
                    let errors = error.response.data.errors;
                    let errorHtml = '<dl class="d-flex flex-column justify-content-start align-items-start">';

                    for (const field in errors) {
                        errorHtml += '<dt>' + field.replace('_', ' ').toUpperCase() + '</dt>'
                        for (let index = 0; index < errors[field].length; index++) {
                            errorHtml += '<dd><span class="text-danger">*' +errors[field][index]+ '</dd>'
                        }
                    }

                    errorHtml += '</dl>';

                    Swal.fire({
                        title:'Error',
                        icon:'error',
                        html: errorHtml
                    });

                })
                .finally(() => console.log('finally'));

            } else {
                $(e.currentTarget).attr('disabled', false);
            }

        });
    }

}


