require('./bootstrap');

import 'alpinejs';

// Modules for the Application
import Sanctum from './Sanctum';
import Login from './Login';
import Admin from './Admin/Admin';

$(document).ready(() => {
    new Sanctum();
    new Login();
    new Admin();
});
