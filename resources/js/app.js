require('./bootstrap');

import 'alpinejs';

// Modules for the Application
import SaveBranch from './Admin/SaveBranch';

$(document).ready(() => {
    new SaveBranch();
});
