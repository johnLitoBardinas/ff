require('./bootstrap');

import 'alpinejs';

// Modules for the Application
import SaveBranch from './Admin/SaveBranch';
import BranchStatus from './Admin/BranchStatus';

$(document).ready(() => {
    // Register Admin Interactions.
    new SaveBranch();
    new BranchStatus();
});
