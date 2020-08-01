
import Swal from 'sweetalert2';

/**
 * Format the branch form data to accepted API data.
 *
 * @param {$.serializeObject} data Branch Form Data.
 */
export function formatBranchData (data){
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
};