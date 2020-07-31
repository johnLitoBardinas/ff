export default class Sanctum {
    constructor () {
        axios.get('/sanctum/csrf-cookie').then(response => {
            console.log('setup front + back via cookie and csrf protection', response);
        });
    }
}