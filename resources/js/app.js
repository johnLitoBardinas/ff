require('./bootstrap');

import 'alpinejs';

import AppPlugins from './plugins';

// Modules for the Application
import SaveBranch from './Admin/SaveBranch';
import BranchStatus from './Admin/BranchStatus';
import BranchUsers from './Admin/BranchUsers';
import Package from './Admin/Package';

import SalonTable from './Salon/SalonTable';
import SaveNewCustomer from './Salon/SaveNewCustomer';
import SaveCustomerVisits from './Salon/SaveCustomerVisits';

import RenewCustomer from './Salon/RenewCustomer';

$(document).ready(function() {

    // Plugins
    new AppPlugins();

    // Admin Interactions.
    new SaveBranch();
    new BranchStatus();
    new BranchUsers();

    new Package();

    // Salon Interaction
    new SalonTable();
    new SaveNewCustomer();
    new SaveCustomerVisits();
    new RenewCustomer();

});

// $(document).on("#btn-save-branch-user", "click", (e) => {
//     console.log('Event in app.js');
//     console.log('event', e);
//     console.log('target', e.currentTarget);
// });