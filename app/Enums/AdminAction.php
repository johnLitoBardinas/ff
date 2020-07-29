<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdminAction extends Enum
{
    // determining the state for the component [readBranch, addBranch, editBranch, deactivateBranch, addNewUser, deleteBranch]
    const READ_BRANCH = 'readBranch';
    const ADD_BRANCH = 'addBranch';
    const EDIT_BRANCH = 'editBranch';
    const DEACTIVATE_BRANCH = 'deactivateBranch';
    const ADD_BRANCH_USER = 'addNewUser';
    const DELETE_BRANCH = 'deleteBranch';
}
