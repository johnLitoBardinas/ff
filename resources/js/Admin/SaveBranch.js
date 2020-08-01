import { formatBranchData } from '../utils';

export default class SaveBranch {

    constructor () {
        this.$adminBranchForm = $(".admin-branches-form");
        this.$btnSaveBranch = $("#btn-savebranch");

        this.branchApi = '/api/branch';

        this.saveBranchForm();
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            const data = formatBranchData(this.$adminBranchForm.find("#frm-branch").serializeObject());
            // console.log('current branch id', data['current_branch_id']);
            // console.log('current branch action', data['current_branch_id']);
            return;
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