import { formatBranchData } from '../utils';

export default class SaveBranch {

    constructor () {
        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");

        this.saveBranchForm();
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            // const data = formatBranchData(this.$adminBranchForm.find("#frm-branch").serialize());
            const data = this.$adminBranchForm.find("#frm-branch").serializeObject();
            const users = [];
            console.log('before data', data);
            data['user_ids'].forEach((value, index) => {
                let user = {};
                user['user_ids'] = value;
                user['branch_ids'] = data['branch_ids'][index];
                user['email'] = data['email'][index];
                user['first_name'] = data['first_name'][index];
                user['last_name'] = data['last_name'][index];
                user['mobile_number'] = data['mobile_number'][index];
                user['role_ids'] = data['role_ids'][index];
                users.push(user);
            });
            data.users = users;

            delete data['user_ids'];
            delete data['branch_ids'];
            delete data['email'];
            delete data['first_name'];
            delete data['last_name'];
            delete data['mobile_number'];
            delete data['role_ids'];

            // Need to Improve.
            axios.post('/api/branch', data)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err);
            });

        });
    }

}