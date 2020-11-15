require('./bootstrap');

import 'alpinejs';

import AppPlugins from './plugins';

// Modules for the Application

import ChangeUserEmail from './SuperAdmin/ChangeUserEmail';

import SaveBranch from './Admin/SaveBranch';
import BranchStatus from './Admin/BranchStatus';
import BranchUsers from './Admin/BranchUsers';
import Package from './Admin/Package';

import ManagementTable from './Management/ManagementTable';
import SaveNewCustomer from './Management/SaveNewCustomer';
import SaveCustomerVisits from './Management/SaveCustomerVisits';

import RenewCustomer from './Management/RenewCustomer';

$(document).ready(function() {

    // Plugins
    new AppPlugins();

    // SuperAdmin
    new ChangeUserEmail();

    // Admin Interactions.
    new SaveBranch();
    new BranchStatus();
    new BranchUsers();

    new Package();

    // Management Interaction (Cashier + Manager)
    new ManagementTable();
    new SaveNewCustomer();
    new SaveCustomerVisits();
    new RenewCustomer();

});
