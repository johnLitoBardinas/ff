try {
    window.$ = window.jQuery = require('jquery');

    // Attach serializeObject in JQuery
    window.$.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    require('bootstrap');
} catch (e) {}

window.ApiUrl = {
    branch: '/api/branch',
    users: '/api/users',
    customers: '/api/customers',
    packages: '/api/packages'
};

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.default.withCredentials = true;
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + document.querySelector('head > meta:nth-child(4)').getAttribute('content');
