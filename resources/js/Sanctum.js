/**
 * Currently not Needed.
 */
export default class Sanctum {
    constructor () {
        axios.get('/sanctum/csrf-cookie').then(response => {
            console.log('Sanctum');
        });
    }
}