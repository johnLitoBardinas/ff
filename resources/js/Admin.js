export default class Admin {


    constructor () {
        // Admin Add Branch
        this.$btnAddBranch = $("#btn-addbranch");

        // Admin Actions Button
        this.$btnSaveBranch = $("#btn-savebranch");

        // Admin Actions Form
        this.$adminBranchForm = $(".admin-branches-form");

        this.onClickAddBranch();
        this.saveBranchForm();
    }

    onClickAddBranch() {
        this.$btnAddBranch.on('click', () => {
            console.log(window.livewire);
            window.livewire.emit('onAddBranch');
        });
    }

    saveBranchForm() {
        this.$btnSaveBranch.on('click', () => {
            const data = this.$adminBranchForm.find("#frm-branch").serializeArray();
            console.log(data);

            console.log(window.livewire);

            axios.post('/api/branch', data)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err);
            });

        });
    }

}