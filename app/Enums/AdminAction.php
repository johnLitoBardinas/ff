<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AdminAction extends Enum
{
    // determining the state for the component [readBranch, addBranch, editBranch, deactivateBranch, addNewUser, deleteBranch]
    public const READ_BRANCH = 'readBranch';
    public const ADD_BRANCH = 'addBranch';
    public const SAVE_BRANCH = 'saveBranch';
    public const EDIT_BRANCH = 'editBranch';
    public const DEACTIVATE_BRANCH = 'deactivateBranch';
    public const ADD_BRANCH_USER = 'addNewUser';
    public const DELETE_BRANCH = 'deleteBranch';
}
