/**
 * All the Logic for the Login Form.
 */

export default class Login {

    constructor() {
        this.$loginForm = $("#login");
        this.onClickLogin();
    }

    onClickLogin() {
        this.$loginForm.on('submit', (e) => {
            e.preventDefault();
            const data = $(e.currentTarget).serialize();
            console.log(data);
            axios.post('/login', data)
            .then((response) => console.log(response))
            .catch((error) => console.log(error));
        });
    }

}