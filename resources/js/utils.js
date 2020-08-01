
import Swal from 'sweetalert2';

/**
 * Format the branch form data to accepted API data.
 * @param {$.serializeObject} data
 */
export function formatBranchData (data){
    const users = [];

    console.log('passed', data);
    return;
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