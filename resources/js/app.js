require('./bootstrap');

import 'alpinejs';

// Modules for the Application
import SaveBranch from './Admin/SaveBranch';
import BranchStatus from './Admin/BranchStatus';
import BranchUsers from './Admin/BranchUsers';

import SaveNewCustomer from './Salon/SaveNewCustomer';

$(document).ready(() => {
    // Admin Interactions.
    new SaveBranch();
    new BranchStatus();
    new BranchUsers();

    // Salon Interaction
    new SaveNewCustomer();
});
