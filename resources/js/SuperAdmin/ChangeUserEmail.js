const utils = require('../utils');
import Swal from 'sweetalert2';

export default class ChangeUserEmail {

    constructor() {

        this.$userEmailTable = $("#user-email-tables");


        this.onChangeUserEmail();
    }

    onChangeUserEmail() {

        this.$userEmailTable.on('click', 'td[colspan="2"] > button', (e) => {
            e.preventDefault();
            $(e.currentTarget).attr('disabled', true);
            const { userid, sadmin, useroldemail } = e.currentTarget.dataset;
            const newEmail = $(e.currentTarget).prev('input').val();

            if (useroldemail === newEmail ) {
                Swal.fire(utils.swal2Option('error', 'Error!!', 'Update the email'));
                return;
            }

            axios.put(`${ApiUrl.users}/${userid}/changeemail`, {
                'user_id': userid,
                'sadmin': sadmin,
                'email': newEmail
            })
            .then((response) => {
                Swal.fire(utils.swal2Option('success', 'Success!!', `User email: ${useroldemail} is now update to ${newEmail}`));
                window.livewire.emit('onUpdateUserEmail');
            })
            .catch((error) => {
                utils.axiosErrorCallback(error)
            })
            .finally((params) => {
                $(e.currentTarget).attr('disabled', false);
            })
            // console.log('dataset', e.currentTarget.dataset);
        });
    }

}


