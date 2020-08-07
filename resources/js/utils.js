/**
 * Utility Functions.
 */

const util = {

    /**
     * Fire the onUpdateBranch && onChangeBranch event.
     *
     * @param {Int} branchId Branch ID.
     */
    updateBranch: (branchId) => {
        window.livewire.emit('onUpdateBranch', branchId);
        window.livewire.emit('onChangeBranch', branchId);
    },

    /**
     * Format the branch form data to accepted API data.
     *
     * @param {$.serializeObject} data Branch Form Data.
     */
    formatBranchData: (data) => {
        const users = [];

        if ( data['user_id'] === undefined ) {
            data.users = users;
        } else if ( typeof data['user_id'] === "string" ) {
            let user = {};
            user['user_id'] = data['user_id'];
            user['branch_id'] = data['branch_id'];
            user['email'] = data['email'];
            user['first_name'] = data['first_name'];
            user['last_name'] = data['last_name'];
            user['mobile_number'] = data['mobile_number'];
            user['role_id'] = data['role_id'];
            users.push(user);
        } else if ( typeof data['user_id'] === "object") {
            data['user_id'].forEach((value, index) => {
                let user = {};
                user['user_id'] = value;
                user['branch_id'] = data['branch_id'][index];
                user['email'] = data['email'][index];
                user['first_name'] = data['first_name'][index];
                user['last_name'] = data['last_name'][index];
                user['mobile_number'] = data['mobile_number'][index];
                user['role_id'] = data['role_id'][index];
                users.push(user);
            });
        }

        data.users = users;

        delete data['user_id'];
        delete data['branch_id'];
        delete data['email'];
        delete data['first_name'];
        delete data['last_name'];
        delete data['mobile_number'];
        delete data['role_id'];

        return data;
    },

    /**
     * Format the Active/Inactive to Activate/Deactivate.
     *
     * @param {String} status active/inactive.
     * @return {String} formatted Status.
     */
    formatStatus: (status) => {
        let formatted;
        switch (status) {
            case 'active':
                formatted = 'Activate';
            break;

            case 'inactive':
                formatted = 'Deactivate';
            break;

            default:
                console.log('Valid Status (\'active\'|\'inactive\')');
            break;
        }
        return formatted;
    },

    /**
     * Displaying the common SweatAlert2 variation.
     *
     * Success
     * Warning
     * Danger
     *
     * @param {String} type Variation of SWAL.
     * @param {String} title Title of SWAL.
     * @param {String} message Message of SWAL.
     *
     * @return {Object} SWAL 2 valid option.
     */
    swal2Option: (type='success', title='Success', text='Success Message!!') => {
        let option;
        switch (type) {
            case 'warning':
                option = {
                    title,
                    text,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonColor: '#463291',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                };
                break;

            default:
                break;
        }

        return option;
    }
};

module.exports = util;