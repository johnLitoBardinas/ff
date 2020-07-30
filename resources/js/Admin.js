export default class Admin {


    constructor () {
        // Admin Actions Button
        this.$btnSaveBranch = $("#btn-savebranch");

        // Admin Actions Form
        this.$adminBranchForm = $(".admin-branches-form");
        this.saveBranchForm();
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            const data = this.$adminBranchForm.find("#frm-branch").serializeArray();
            console.log(data);
            // Ok ready...
        });
    }

}